<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo', 'favicon', 'site_name', 'site_title',
        'registration_bonus', 'minimum_withdraw', 'maximum_withdraw',
        'withdraw_charge', 'open_transfer', 'auto_transfer', 'auto_transfer_default',
        'telegram', 'channel', 'open_deposit', 'auto_deposit',
        'w_time_status', 'checkin',
        'total_member_register_reword', 'total_member_register_reword_amount',
        'minimum_recharge', 'maximum_recharge',
    ];
}
