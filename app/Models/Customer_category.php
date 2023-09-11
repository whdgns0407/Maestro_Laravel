<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title',
        'content',
        'use',
        'created_at',
        'updated_at',
    ];
}
