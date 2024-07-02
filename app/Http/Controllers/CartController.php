<?php

namespace App\Http\Controllers;

use App\Exceptions\CartException;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Repos\CartRepo;
use App\Traits\JsonResponse;

class CartController extends Controller
{
    use JsonResponse;

    private CartRepo $repo;

    public function __construct()
    {
        $this->repo = new CartRepo;
    }

    public function index()
    {
        return view('pages.cart.index', [
            'carts' => Cart::with('item')->get(),
        ]);
    }

    public function store(CartRequest $request)
    {
        try {
            $this->repo->store($request->user(), $request->validated());
            return $this->jsonResponse('Barang ditambahkan ke cart');
        } catch (CartException $e) {
            return $this->jsonResponse($e->getMessage(), false, 400);
        }
    }

    public function update(CartRequest $request)
    {
        try {
            $this->repo->update($request->user(), $request->validated());
            return $this->jsonResponse('Cart berhasil diupdate');
        } catch (CartException $e) {
            return $this->jsonResponse($e->getMessage(), false, 400);
        }
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();
        return back()->with('swal_s', 'Berhasil menghapus cart');
    }

    public function checkout()
    {
        try {
            $purchase = $this->repo->checkout(request()->user());
            return to_route('purchase.show', $purchase);
        } catch (CartException $e) {
            return back()->with('swal_e', $e->getMessage());
        }
    }
}
