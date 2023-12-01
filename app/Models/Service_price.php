<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service_price extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
    ];

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}