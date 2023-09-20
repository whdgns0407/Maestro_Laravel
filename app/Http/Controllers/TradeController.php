<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Api_exchange;
use App\Models\Hoga_txids;
use App\Models\Users_txid;
use App\Models\User;



class TradeController extends Controller
{

    public function index(Request $request, $coin)
    {
        if (!$this->coin_is($coin)) {
            session()->flash('message', '존재하지 않는 코인입니다.');
            return redirect()->route('trade_index', ['coin' => 'BTC']);
        }

        return view('trade.index', ['coin' => $coin,]);
    }

    public function trade_hoga_ajax(Request $request, $coin)
    {

        if (!$this->coin_is($coin)) {
            response('선택하신 코인은 없습니다.', 409);
        }


        $hoga_buy = Hoga_txids::select('price', DB::raw('SUM(amount) as total_amount'))
            ->where('type', 'buy')
            ->where('coin', $coin)
            ->where('status', 0)
            ->groupBy('price')
            ->orderBy('price', 'desc')
            ->limit(10)
            ->get();

        $hoga_sell = Hoga_txids::select('price', DB::raw('SUM(amount) as total_amount'))
            ->where('type', 'sell')
            ->where('coin', $coin)
            ->where('status', 0)
            ->groupBy('price')
            ->orderBy('price', 'asc')
            ->limit(10)
            ->get();

        $json_data = [
            'buy' => $hoga_buy,
            'sell' => $hoga_sell,
        ];


        return $json_data;
    }


    public function trade_input(Request $request)
    {
        $type =  $request->input('type');

        if ($type != "buy" && $type != "sell") {
            response('매수 또는 매도만 가능합니다. 정상적인 경로를 이용해주세요.', 409);
        }

        $coin = $request->input('coin');
        if (!$this->coin_is($coin)) {
            response('선택하신 코인은 없습니다.', 409);
        }

        $amount = $request->input('amount');
        $price = $request->input('price');

        if (!is_numeric($amount) || !is_numeric($price)) {
            response('가격과 수량은 숫자만 입력할 수 있습니다.', 409);
        }


        $user_id = auth()->user()->user_id;
        $user_key = auth()->user()->id;

        $status = 0;

        Hoga_txids::create([
            'user_id' => $user_id,
            'user_key' => $user_key,
            'coin' => $coin,
            'type' => $type,
            'status' => $status,
            'amount' => $amount,
            'price' => $price,
        ]);


        return "완료 되었습니다.";
    }

    public function coin_is($coin)
    {
        if (Api_exchange::where('type', $coin)->exists()) {
            return True;
        } else {
            return False;
        }
    }
}
