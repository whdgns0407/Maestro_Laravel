<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board_title_category extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'board_id',
        'title',
    ];
}
