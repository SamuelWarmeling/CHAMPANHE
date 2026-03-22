<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseHistoryController extends Controller
{
    public function index()
    {
        $purchases = Purchase::where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('user.purchases.index', compact('purchases'));
    }
}
