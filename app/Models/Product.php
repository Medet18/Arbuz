<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_of_product',
        'price',
        'category',
        'weight',
        'unit'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }
}
