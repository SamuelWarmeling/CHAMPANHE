<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'photo', 'number', 'tag',
        'minimum_recharge', 'maximum_recharge', 'recharge_charge',
        'minimum_withdraw', 'maximum_withdraw', 'withdraw_charge',
        'status',
    ];
}
