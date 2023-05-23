<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_subs',
        'start_date',
        'end_date',
        'status',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
