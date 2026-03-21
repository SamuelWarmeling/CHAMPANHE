<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'method_name', 'method_number', 'order_id',
        'transaction_id', 'number', 'amount', 'date', 'feedback', 'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
