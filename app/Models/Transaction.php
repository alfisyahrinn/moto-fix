<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'queue_id',
        'payment_status',
        'total_price',
        'payment_method',
        'payment_transaction_id',
        'midtrans_transaction_id',
        'payment_url',
        'payment_expiration',
        'payment_channel',
        'transaction_time',
        'transaction_status',
        'fraud_status',
        'masked_card',
        'gross_amount',
        'expiry_time',
        'currency',
        'channel_response_message',
        'channel_response_code',
        'card_type',
        'bank',
        'approval_code',
        'order_id',
        // Add other fields as needed
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }

    public function service_price()
    {
        return $this->hasOne(Service_price::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}