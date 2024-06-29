<?php

namespace App\Repos;

use App\Exceptions\CartException;
use App\Models\Cart;
use App\Models\Item;
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

        if ($item->stock < $data['qty'])
            throw new CartException('Stok barang ini telah habis');

        if (!$cart)
            return Cart::create(array_merge($clause, ['qty' => $data['qty']]));

        if (($cart->qty + $data['qty']) > $item->stock)
            throw new CartException('Anda tidak dapat menambahkan barang ini lagi');

        $cart->update(['qty' => $cart->qty + $data['qty']]);
        return $cart;
    }
}
