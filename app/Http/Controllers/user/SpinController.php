<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SpinChance;
use App\Models\SpinReward;
use Illuminate\Http\Request;

class SpinController extends Controller
{
    /**
     * Show the spin page with user's current spin chances.
     */
    public function showSpin()
    {
        $userId = auth()->id();

        // Get current chances or default to 0
        $chances = SpinChance::where('user_id', $userId)->value('chances') ?? 0;

        return view('app.spin.index', compact('chances'));
    }

    /**
     * Handle the spin request via AJAX and return JSON response.
     */
    public function spinNow(Request $request)
    {
        $userId = auth()->id();

        // Get current chances
        $chances = SpinChance::where('user_id', $userId)->value('chances') ?? 0;

        // If no chances left
        if ($chances <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'No spin chances left.'
            ]);
        }

        // Define possible rewards with optional image (optional)
        $rewardList = [
            ['reward' => '0', 'image' => '/profelar/coin.jpg'],
            ['reward' => '10', 'image' => '/profelar/coin.jpg'],
            ['reward' => '20', 'image' => '/profelar/coin.jpg'],
            ['reward' => '50', 'image' => '/profelar/coin.jpg'],
            ['reward' => '100', 'image' => '/profelar/coin.jpg'],
        ];

        // Randomly pick a reward
        $rewardItem = $rewardList[array_rand($rewardList)];
        $reward = $rewardItem['reward'];
        $rewardAmount = intval(str_replace('₦', '', $reward));
        $rewardImage = $rewardItem['image'];

        /*/ Save reward record
        SpinReward::create([
            'user_id' => $userId,
            'reward' => $reward
        ]);*/

        // Deduct 1 spin chance
        SpinChance::where('user_id', $userId)->decrement('chances');

        // Add to balance if reward is more than ₦0
        if ($rewardAmount > 0) {
            User::where('id', $userId)->increment('balance', $rewardAmount);
        }

        // Return JSON response
        return response()->json([
            'success' => true,
            'amount' => $reward,
            'image' => $rewardImage,
            'message' => "You won $reward!"
        ]);
    }
        public function spin()
{
    $user = Auth::user();
    $bonusHistory = \App\Models\BonusLedger::where('user_id', $user->id)
        ->latest()
        ->limit(10)
        ->get();

    return view('app.main.spin.index', compact('bonusHistory'));
}


    public function spin_history()
    {
        return view('app.main.spin_history');
    }

    public function submitbonuscheck($code)
    {
        $bonus = Bonus::where('status', 'active')->first();
        $user = Auth::user();
        if ($bonus) {
            if ($code == $bonus->code) {
                //Check this bonus use this user.
                $checkBonusUses = BonusLedger::where('bonus_id',$bonus->id )->where('user_id', $user->id)->first();
                if ($checkBonusUses){
                    return response()->json(['status' => false, 'message' => 'Invalid Code.']);
                }
                if ($bonus->counter < $bonus->set_service_counter) {
                    return response()->json(['status' => true]);
                } else {
                    return response()->json(['status' => false, 'message' => 'targeted fulfil.']);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'Code invalid.']);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Not available.']);
        }
    }



    public function submitbonusamount(Request $request)
{
    $code = $request->code;
    $bonus = Bonus::where('status', 'active')->first();
    $user = Auth::user();

    if ($bonus) {
        if ($code == $bonus->code) {
            // Check if this user has already used the code
            $checkBonusUses = BonusLedger::where('bonus_id', $bonus->id)->where('user_id', $user->id)->first();
            if ($checkBonusUses){
                return redirect()->back()->with('success', 'Do not use this code again.');
            }

            if ($bonus->counter < $bonus->set_service_counter) {
                $amount = $bonus->amount;

                // Update user balance
                $user->balance += $amount;
                $user->save();

                // Record user ledger
                UserLedger::create([
                    'user_id' => $user->id,
                    'reason' => 'Claim',
                    'perticulation' => 'Congratulations '.$user->name.' you have successfully claimed your bonus.',
                    'amount' => $amount,
                    'debit' => $amount,
                    'status' => 'approved',
                    'date' => now()->format('d-m-Y H:i'),
                ]);

                // Update bonus usage count
                $bonus->increment('counter');

                // Record bonus usage
                BonusLedger::create([
                    'user_id' => $user->id,
                    'bonus_id' => $bonus->id,
                    'bonus_code' => $code,
                    'amount' => $amount,
                ]);

                return redirect()->back()->with('success', 'Received ' . price($amount));
            } else {
                return redirect()->back()->with('success', 'Try again later. Bonus limit reached.');
            }
        } else {
            return redirect()->back()->with('success', 'Invalid code.');
        }
    } else {
        return redirect()->back()->with('success', 'Bonus not available yet.');
    }
}
}
