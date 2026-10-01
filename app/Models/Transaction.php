<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number', 'user_id', 'customer_type', 'customer_identity',
        'rental_date', 'return_date', 'subtotal', 'discount_percent',
        'discount_amount', 'jaminan', 'other_fee', 'grand_total',
        'paid_amount', 'change_amount', 'payment_method', 'status',
    ];

    public function details()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
