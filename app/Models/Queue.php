<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
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
    public static function boot()
    {
        parent::boot();

        // Listen for the deleting event
        static::deleting(function ($queue) {
            // Delete the associated transaction if exists
            if ($queue->transaction) {
                $queue->transaction->delete();
            }
        });
    }
}
