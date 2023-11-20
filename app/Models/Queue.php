<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_queue',
        'status',
        'time',
        'problem',
        'number_plate',
        'merk'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function transaction(){
        return $this->hasOne(Transaction::class);
    }
}
