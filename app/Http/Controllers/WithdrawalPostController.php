<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawalPostController extends Controller
{
    public function store(Request $request)
    {
        // stub — implementar lógica de postagem de saque
        return redirect()->back()->with('success', 'Postagem enviada.');
    }
}
