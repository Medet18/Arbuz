<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_day',
        'address',
        'phone',
    ];

    public function cart(){
        return $this->belongsTo(Cart::class);
    }

    public function subscription()
    {
        return $this->belongsTo(Subscription::class);
    }

}
