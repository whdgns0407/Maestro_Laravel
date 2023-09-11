<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_reply extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'customers_uuid',
        'customers_id',
        'content',
        'created_at',
        'updated_at',
    ];
}
