<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hoga_txids extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'user_key',
        'coin',
        'type',
        'amount',
        'price',
        'status',
        'created_at',
        'updated_at',
    ];
}
