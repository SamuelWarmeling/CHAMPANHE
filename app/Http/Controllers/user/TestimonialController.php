<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create()
    {
        return view('admin.pages.testimonials.create');
    }

    public function store(Request $request)
    {
        // stub — implementar lógica de testemunho
        return redirect()->back()->with('success', 'Testemunho enviado.');
    }
}
