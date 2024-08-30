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
        $qty = ($cart?->qty ?? 0) + $data['qty'];

        return $this->manage($cart, $item, $qty, $clause);
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
        $total = $carts->sum(fn ($cart) => $cart->item->price * $cart->qty);
      
        if ($carts->count() < 1)
            throw new CartException('Cart masih kosong');

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $total,
            ),
            'customer_details' => array(
                'first_name' => $user->name,
                'email' => $user->email,
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);


        $purchase = Purchase::create([
            'user_id' => $user->id,
            'datetime' => now(),
            'status' => PurchaseStatus::UNPAID,
            'snap_token' => $snapToken,
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

            $cart->item->decrement('stock', $cart->qty);
            $cart->delete();
        });

        return $purchase;
    }

    private function manage(Cart|null $cart, Item $item, $qty, array $data = []): Cart|bool
    {
        if ($qty > $item->stock)
            throw new CartException('Anda tidak dapat menambahkan barang ini lagi');

        if (!$cart)
            return Cart::create(array_merge($data, ['qty' => $qty]));

        if ($qty <= 0)
            return $cart->delete();

        $cart->update(compact('qty'));
        return $cart;
    }
}
