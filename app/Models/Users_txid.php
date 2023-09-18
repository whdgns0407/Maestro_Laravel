<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users_txid extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', // 기본키
        'users_pk', // 유저 기본키 값
        'user_id', // 유저 아이디 값
        'coin', // 코인 종류(BTC, ETH, BCH등등)
        'type', // 종류(입금, 출금, 매수, 매도)
        'trades_volume', // 거래수량
        'trades_price', // 거래단가
        'trades_total_price', // 거래금액
        'fee', // 수수료
        'settlement_amount', // 정산금액 (수수료 반영)
        'created_at', // 만든시간
        'updated_at', // 업데이트한 시간
    ];
}
