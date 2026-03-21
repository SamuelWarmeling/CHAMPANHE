<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'phone_code',
        'realname',
        'bank_name',
        'gateway_method',
        'gateway_address',
        'password',
        'ref_id',
        'ref_by',
        'code',
        'type',
        'balance',
        'total_income',
        'today_income',
        'ip',
        'vip_level',
        'investor',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'balance'           => 'float',
        'total_income'      => 'float',
        'today_income'      => 'float',
    ];
}
