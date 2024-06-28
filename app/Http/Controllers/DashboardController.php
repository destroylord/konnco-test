<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('pages.home', [
            'items' => Item::all(),
        ]);
    }
}
