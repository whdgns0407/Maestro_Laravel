<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;


    protected $fillable = [
        'id',
        'board_categories_id',
        'board_categories_name',
        'user_id',
        'nickname',
        'title_categories_id',
        'title_categories_name',
        'title',
        'content',
        'hit',
        'delete',
        'ban',
        'created_at',
        'updated_at'
    ];
}
