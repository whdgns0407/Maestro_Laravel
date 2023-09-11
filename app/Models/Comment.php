<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'board_id',
        'user_id',
        'nickname',
        'body',
        'parent_id',
        'delete',
        'ban',
        'created_at',
        'updated_at',
    ];
}
