<?php

namespace App\Http\Controllers;

use App\Enums\PurchaseStatus;
use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{

    public function index()
    {
        return view('pages.purchase.index', [
            'purchases' => Purchase::where('user_id', request()->user()->id)->get()
        ]);
    }
    public function show(Purchase $purchase)
    {
        return view('pages.purchase.show', compact('purchase'));
    }

    public function update(Request $request, $id)
    {
      
        $purchase = Purchase::find($id);

        if (!$purchase) {
            return response()->json(['error' => 'Purchase not found'], 404);
        }

        // Update status pembelian berdasarkan hasil transaksi
        if ($request->input('result') === 'success') {
            $purchase->update(['status' => 'paid']);
        } else {
            $purchase->update(['status' => 'pending']);
        }

        return response()->json(['message' => 'Status updated successfully'], 200);

    //    return to_route('purchase.show', $purchase);
    }
}
