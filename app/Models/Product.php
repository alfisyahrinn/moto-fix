<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
        'supplier_id',
        'category_id',
    ];


    public function scopeFilter($query){
        if (request('search')) {
            return $query->where('name', 'like', '%'.request('search').'%')
                        ->orWhere('description', 'like', '%'.request('search').'%')
                        ->orWhere('price', 'like', '%'.request('search').'%');
        }

    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function category(){
        return $this->belongsTo(Category::class);
    }
}