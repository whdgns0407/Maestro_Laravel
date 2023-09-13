<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'email',
        'email_code',
        'email_authentication',
        'user_id',
        'password',
        'nickname',
        'remember_token',
        'KRW',
        'KRW_using',

        'BTC',
        'BTC_using',
        'ETH',
        'ETH_using',
        'BCH',
        'BCH_using',
        'ETC',
        'ETC_using',
        'EOS',
        'EOS_using',
        'XRP',
        'XRP_using',
        'ADA',
        'ADA_using',
        'DOGE',
        'DOGE_using',

        'admin',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
