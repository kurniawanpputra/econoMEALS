<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'food_id', 'user_id', 'seller_id', 'qty', 'phone', 'status'
    ];

    protected $table = 'orders';
}
