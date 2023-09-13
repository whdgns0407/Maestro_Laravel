<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Api_exchange extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'exchange',
        'type',
        'markets_code',
        'sell5_amount',
        'sell5_price',
        'sell4_amount',
        'sell4_price',
        'sell3_amount',
        'sell3_price',
        'sell2_amount',
        'sell2_price',
        'sell1_amount',
        'sell1_price',
        'buy1_amount',
        'buy1_price',
        'buy2_amount',
        'buy2_price',
        'buy3_amount',
        'buy3_price',
        'buy4_amount',
        'buy4_price',
        'buy5_amount',
        'buy5_price',
    ];


}
