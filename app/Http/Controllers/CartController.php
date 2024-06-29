<?php

namespace App\Http\Controllers;

use App\Exceptions\CartException;
use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Repos\CartRepo;
use Illuminate\Http\Request;

use function Pest\Laravel\json;

class CartController extends Controller
{
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

            return response()
                ->json([
                    'status' => true,
                    'message' => 'Barang ditambahkan ke keranjang'
                ]);
        } catch (CartException $e) {
            return response()
                ->json([
                    'status' => false,
                    'message' => $e->getMessage()
                ], 400);
        }
    }
}
