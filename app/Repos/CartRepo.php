<?php

namespace App\Repos;

use App\Enums\PurchaseStatus;
use App\Exceptions\CartException;
use App\Models\Cart;
use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;

class CartRepo
{
    public function store(User $user, array $data): Cart
    {
        $clause = [
            'user_id' => $user->id,
            'item_id' => $data['item_id'],
        ];

        $cart = Cart::where($clause)->first();
        $item = Item::find($data['item_id']);

        if (!$cart)
            return Cart::create(array_merge($clause, ['qty' => $data['qty']]));

        return $this->manage($cart, $item, $cart->qty + $data['qty']);
    }

    public function update(User $user, array $data): Cart|bool
    {
        $cart = Cart::where([
            'user_id' => $user->id,
            'item_id' => $data['item_id'],
        ])->first();

        if (!$cart)
            throw new CartException('Barang ini tidak ada di dalam cart');

        return $this->manage($cart, $cart->item, $data['qty']);
    }

    public function checkout(User $user): Purchase
    {
        $carts = Cart::where('user_id', $user->id)->get();

        if ($carts->count() < 1)
            throw new CartException('Cart masih kosong');

        $purchase = Purchase::create([
            'user_id' => $user->id,
            'datetime' => now(),
            'status' => PurchaseStatus::UNPAID,
            'file' => null,
            'total' => $carts->sum(fn ($cart) => $cart->item->price * $cart->qty)
        ]);

        $carts->map(function ($cart) use ($purchase) {
            $purchase->details()->create([
                'purchase_id' => $purchase->id,
                'item_id' => $cart->item_id,
                'price' => $cart->item->price,
                'qty' => $cart->qty,
                'total' => $cart->item->price * $cart->qty,
            ]);

            $cart->delete();
        });

        return $purchase;
    }

    private function manage(Cart $cart, Item $item, $qty): Cart|bool
    {
        if ($qty > $item->stock)
            throw new CartException('Anda tidak dapat menambahkan barang ini lagi');

        if ($qty <= 0)
            return $cart->delete();

        $cart->update(compact('qty'));
        return $cart;
    }
}
