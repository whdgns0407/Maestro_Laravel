<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'user_id',
        'filename',
        'uuid',
        'created_at',
        'updated_at',
    ];
}
