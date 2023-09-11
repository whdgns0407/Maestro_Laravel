<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'english_name',
        'korean_name',
        'notice',
        'admin_write',
        'reply_use',
        'created_at',
        'updated_at',
    ];
}
