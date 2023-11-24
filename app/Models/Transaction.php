<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'total_price',
    ];

    public function queue(){
        return $this->belongsTo(Queue::class);
    }
    public function service_price(){
        return $this->hasOne(Service_price::class);
    }
}