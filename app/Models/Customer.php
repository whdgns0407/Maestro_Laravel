<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'uuid',
        'user_id',
        'type',
        'title',
        'content',
        'status',
        'filename0',
        'filesrc0',
        'filename1',
        'filesrc1',
        'filename2',
        'filesrc2',
        'filename3',
        'filesrc3',
        'created_at',
        'updated_at'
    ];
}
