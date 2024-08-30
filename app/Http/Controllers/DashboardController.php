<?php

namespace App\Http\Controllers;

use App\Enums\ItemStatus;
use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        return view('pages.home', [
            'items' => Item::where('status', ItemStatus::ACTIVE)->get(),
        ]);
    }
}
