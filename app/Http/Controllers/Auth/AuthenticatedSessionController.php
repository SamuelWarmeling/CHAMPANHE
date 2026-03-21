<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Deposit;
use App\Models\User;
use App\Models\UserLedger;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(Request $request)
    {
        if (Auth::check()){
            return redirect()->route('home');
        }
        return view('app.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request){
       $user = User::where('phone', $request->phone)->first();

       if (!$user){
           return response()->json(['error' => 'Mobile number not registered.'], 401);
        }

        //Check user ban or unban
        if (isset($user->ban_unban) && $user->ban_unban == 'ban')
        {
            return response()->json(['error' => 'Your account has been banned.'], 403);
        }

        if (Hash::check($request->password, $user->password)){
            Auth::login($user);
            $request->session()->regenerate();
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Incorrect login password.'], 401);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
