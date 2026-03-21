<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Http\Services\PaymentServices;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UserLedger;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Deposit;
use App\Models\Purchase;
use App\Models\Setting;
use Carbon\Carbon;

class WithdrawController extends Controller
{
    public function withdraw_history()
    {
        $withdraws = Withdrawal::where('user_id', auth()->id())
            ->orderByDesc('id')
            ->get();

        return view('app.main.withdraw_history', compact('withdraws'));
    }

    public function withdraw()
    {
    $setting = \App\Models\Setting::first();
    $minWithdraw = $setting->minimum_withdraw ?? 0;
    $maxWithdraw = $setting->maximum_withdraw ?? 0;
    $withdrawCharge = $setting->withdraw_charge ?? 0;

    if (auth()->user()->gateway_method && auth()->user()->gateway_address) {
        return view('app.main.withdraw.index', compact('minWithdraw', 'maxWithdraw', 'withdrawCharge'));
    } else {
        return redirect()->route('user.bank')->with('success', 'First create a bank account');
    }
    }

    public function withdrawRequest(Request $request, PaymentServices $payment)
    {
        $now = Carbon::now('Africa/Harare');

        // if ($now->hour < 10 || $now->hour >= 16) {
        //     return redirect()->back()->with('error', 'Withdrawals are allowed only between 10:00 AM and 4:00 PM.');
        // }

        $dailyWithdrawCount = Withdrawal::where('user_id', auth()->id())
            ->whereDate('created_at', Carbon::today())
            ->count();

        if ($dailyWithdrawCount >= 2) {
            return redirect()->back()->with('error', 'You can only withdraw 2 times per day.');
        }

        $validate = Validator::make($request->all(), [
            'amount' => 'required|numeric',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate)->withInput();
        }

        $user = auth()->user();
        $setting = Setting::first();

        $payments = Deposit::where('user_id', $user->id)->where('status', 'approved')->count();
        if ($payments < 1) {
            return redirect()->back()->with('error', "You can't withdraw before depositing.");
        }

        if (!Purchase::where('user_id', $user->id)->exists()) {
            return redirect()->back()->with('error', "You need to invest before withdrawing.");
        }

        if ($setting->open_transfer != 1) {
            return redirect()->back()->with('error', "Withdrawals are currently disabled. Try again later.");
        }

        $amount = $request->amount;
        if ($amount > $user->balance) {
            return redirect()->back()->with('error', 'Insufficient balance for withdrawal.');
        }

        // ✅ Check against minimum and maximum withdrawal
        if ($amount < $setting->minimum_withdraw) {
            return redirect()->back()->with('error', 'Minimum withdrawal is ₦' . number_format($setting->minimum_withdraw, 2));
        }

        if ($amount > $setting->maximum_withdraw) {
            return redirect()->back()->with('error', 'Maximum withdrawal is ₦' . number_format($setting->maximum_withdraw, 2));
        }

        $vipLevel = $user->vip_level ?? 0;
        if ($vipLevel >= 10) {
            $chargeRate = 7;   // Elite
        } elseif ($vipLevel >= 1) {
            $chargeRate = 10;  // VIP
        } else {
            $chargeRate = 15;  // Comum
        }
        $charge = ($amount * $chargeRate) / 100;

        $debit_wallet = debit_user_wallet($user->id, 2, 'NGN', $amount);
        if ($debit_wallet['status'] == false) {
            return redirect()->back()->with('error', $debit_wallet['message']);
        }

        $finalAmount = $amount - $charge;
        $status_id = 'pending';
        $status_text = 'Withdraw request under review.';
        $reference = rand(10000, 99999);

        if ($setting->auto_transfer) {
            $transfer = $payment->payout(
                $reference,
                "NGN",
                $finalAmount,
                $setting->auto_transfer_default,
                $user->gateway_method,
                $user->gateway_address,
                $user->realname
            );

            if ($transfer['status'] == false) {
                credit_user_wallet($user->id, 2, 'NGN', $amount);
                return redirect()->back()->with('error', $transfer['message']);
            }

            $status_id = 'approved';
            $status_text = 'Your withdrawal has been approved.';
        }

        $paymenMethod = PaymentMethod::where('tag', $setting->auto_transfer_default)->first();

        $withdrawal = new Withdrawal();
        $withdrawal->user_id = $user->id;
        $withdrawal->method_name = $paymenMethod->name ?? '---';
        $withdrawal->trx = $reference;
        $withdrawal->account_info = json_encode([
            'bank_account' => $user->gateway_address,
            'full_name' => $user->realname,
            'bank_name' => $user->bank_name,
            'bank_code' => $user->gateway_method,
        ]);
        $withdrawal->number = $user->gateway_address;
        $withdrawal->amount = $amount;
        $withdrawal->currency = 'NGN';
        $withdrawal->charge = $charge;
        $withdrawal->oid = 'W-' . rand(100000, 999999) . rand(100000, 999999);
        $withdrawal->final_amount = $finalAmount;
        $withdrawal->status = $status_id;

        if ($withdrawal->save()) {
            $ledger = new UserLedger();
            $ledger->user_id = $user->id;
            $ledger->reason = 'withdraw_request';
            $ledger->perticulation = $user->bank_name . ' ' . $user->gateway_address;
            $ledger->amount = $amount;
            $ledger->debit = $finalAmount;
            $ledger->status = 'approved';
            $ledger->date = now()->format('Y-m-d H:i');
            $ledger->save();
        }

        return redirect()->back()->with('success', $status_text);
    }

    public function withdrawPreview()
    {
        $withdraws = Withdrawal::with('payment_method')
            ->where('user_id', Auth::id())
            ->orderByDesc('id')
            ->get();

        return view('app.main.withdraw_history', compact('withdraws'));
    }
}
