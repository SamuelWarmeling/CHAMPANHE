<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Checkin;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisteredUserController extends Controller
{
    public function create(Request $request, $id = null)
    {
        if ($id) {
            $user = User::find($id);
            if ($user) {
                $user->delete();
            }
        }

        $ref_by = $request->query('ref');
        return view('app.auth.registration', compact('ref_by'));
    }

    public function store(Request $request)
    {
        // Verificação explícita de telefone duplicado com mensagem em português
        if (User::where('phone', $request->phone)->exists()) {
            return response()->json([
                'error' => 'Este telefone já está cadastrado. Faça login ou use outro número.'
            ], 422);
        }

        $validate = Validator::make($request->all(), [
            'phone'    => ['required'],
            'password' => ['required', 'min:6'],
        ], [
            'phone.required'    => 'O número de telefone é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
            'password.min'      => 'A senha deve ter pelo menos 6 caracteres.',
        ]);

        if ($validate->fails()) {
            return response()->json(['error' => $validate->errors()->first()], 422);
        }

        /*/ ✅ Check for IP limit
        $userIP = $request->ip();
        $existing = User::where('ip', $userIP)->first();
        if ($existing) {
            return redirect()->back()->with('error', 'Only one account allowed per IP address.');
        }*/

        try {
            $bonus        = Setting::first()?->registration_bonus ?? 0;
            $referralCode = $this->generateUniqueReferralCode();
            $appName      = config('app.name', 'EMI');

            $user = User::create([
                'name'     => 'u' . $request->phone,
                'username' => $appName,
                'ref_id'   => $referralCode,
                'ref_by'   => $request->ref_by ?: null,
                'email'    => 'user' . rand(1000, 9999) . Str::random(4) . '@emi.com',
                'phone'    => $request->phone,
                'password' => Hash::make($request->password),
                'type'     => 'user',
                'balance'  => $bonus,
            ]);

            Checkin::create([
                'user_id' => $user->id,
                'date'    => now()->format('Y-m-d H:i:s'),
                'amount'  => 0,
            ]);

            if ($bonus > 0) {
                UserLedger::create([
                    'user_id'       => $user->id,
                    'reason'        => 'signup_bonus',
                    'perticulation' => 'Registration bonus',
                    'amount'        => $bonus,
                    'credit'        => $bonus,
                    'status'        => 'approved',
                    'step'          => 'self',
                    'date'          => now()->format('Y-m-d H:i'),
                ]);
            }

            Auth::login($user);
            $request->session()->regenerate();
            return response()->json(['success' => true]);

        } catch (\Throwable $e) {
            Log::error('Registration failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
            ]);
            return response()->json(['error' => 'Erro ao registrar: ' . $e->getMessage()], 500);
        }
    }

    private function generateUniqueReferralCode($length = 6)
    {
        do {
            $code = strtoupper(Str::random($length));
        } while (User::where('ref_id', $code)->exists());

        return $code;
    }
}
