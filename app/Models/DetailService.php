<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailService extends Model
{
    use HasFactory;
    protected $fillable = ['transaction_id', 'product_id', 'service_id', 'quantity'];


    public function service()
    {
        return $this->belongsTo(Service_price::class, 'service_id');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class);
}

}