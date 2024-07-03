<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseRequest;
use App\Models\Purchase;

class PurchaseController extends Controller
{
    public function show(Purchase $purchase)
    {
        return view('pages.purchase.show', compact('purchase'));
    }

    public function upload(PurchaseRequest $request, Purchase $purchase)
    {
        $file = $request->file('file');

        $purchase->update([
            'file' => $file->storePublicly('purchases', 'public'),
        ]);

        return to_route('purchase.show', $purchase);
    }
}
