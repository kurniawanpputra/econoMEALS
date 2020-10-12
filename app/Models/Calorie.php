<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calorie extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'weight', 'multiplier', 'gender', 'calories'
    ];

    protected $table = 'calories';
}
