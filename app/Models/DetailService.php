<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailService extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'product_id',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
