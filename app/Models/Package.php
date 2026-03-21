<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'title', 'photo', 'price', 'code', 'validity',
        'package_commission', 'commission_with_avg_amount', 'sponsor_income',
        'first_ref', 'second_ref', 'third_ref',
        'category', 'vip_level', 'max_purchase_limit',
        'status', 'is_default',
    ];
}
