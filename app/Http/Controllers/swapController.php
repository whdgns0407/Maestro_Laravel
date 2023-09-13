<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use App\Models\Api_exchange;

class swapController extends Controller
{


    // 스왑 원화->코인
    public function swap_krw_to_coin_index()
    {
        return view('swap.index', ['swap_to' => 'coin', 'type' => 'buy']);
    }

    // 스왑 원화->코인
    public function swap_coin_to_krw_index()
    {
        return view('swap.index', ['swap_to' => 'krw', 'type' => 'sell']);
    }

    // ajax
    public function price_ajax()
    {
        // select 다음에 where
        $updated_time = Api_exchange::select('updated_at')
            ->where('id', 1)
            ->first();

        $currentTime = Carbon::now();
        $currentminute = (int)$currentTime->format('i');
        $currentsecond = (int)$currentTime->format('s');

        $currentminus2second = $currentTime->subSeconds(2);
        $sql_updated_time = Carbon::parse($updated_time->updated_at);

        if ($sql_updated_time < $currentminus2second) {
            $url = "https://api.upbit.com/v1/orderbook";
            $markets = "KRW-BTC,KRW-ETH,KRW-BCH,KRW-ETC,KRW-EOS,KRW-XRP,KRW-ADA,KRW-DOGE";
            $upbit_url = Http::withHeaders([
                'Content-Type' => 'application/json',
                // 필요한 헤더 값 설정
            ])->get($url, ['markets' => $markets]);


            $upbit_json_data = json_decode($upbit_url, true);

            for ($i = 0; $i < count($upbit_json_data); $i++) {
                Api_exchange::where('markets_code', $upbit_json_data[$i]['market'])
                    ->update([
                        'sell5_amount' => $upbit_json_data[$i]['orderbook_units'][5]['ask_size'],
                        'sell5_price' => $upbit_json_data[$i]['orderbook_units'][5]['ask_price'],

                        'sell4_amount' => $upbit_json_data[$i]['orderbook_units'][4]['ask_size'],
                        'sell4_price' => $upbit_json_data[$i]['orderbook_units'][4]['ask_price'],

                        'sell3_amount' => $upbit_json_data[$i]['orderbook_units'][3]['ask_size'],
                        'sell3_price' => $upbit_json_data[$i]['orderbook_units'][3]['ask_price'],

                        'sell2_amount' => $upbit_json_data[$i]['orderbook_units'][2]['ask_size'],
                        'sell2_price' => $upbit_json_data[$i]['orderbook_units'][2]['ask_price'],

                        'sell1_amount' => $upbit_json_data[$i]['orderbook_units'][1]['ask_size'],
                        'sell1_price' => $upbit_json_data[$i]['orderbook_units'][1]['ask_price'],

                        'sell0_amount' => $upbit_json_data[$i]['orderbook_units'][0]['ask_size'],
                        'sell0_price' => $upbit_json_data[$i]['orderbook_units'][0]['ask_price'],

                        'buy0_amount' => $upbit_json_data[$i]['orderbook_units'][0]['bid_size'],
                        'buy0_price' => $upbit_json_data[$i]['orderbook_units'][0]['bid_price'],

                        'buy1_amount' => $upbit_json_data[$i]['orderbook_units'][1]['bid_size'],
                        'buy1_price' => $upbit_json_data[$i]['orderbook_units'][1]['bid_price'],

                        'buy2_amount' => $upbit_json_data[$i]['orderbook_units'][2]['bid_size'],
                        'buy2_price' => $upbit_json_data[$i]['orderbook_units'][2]['bid_price'],

                        'buy3_amount' => $upbit_json_data[$i]['orderbook_units'][3]['bid_size'],
                        'buy3_price' => $upbit_json_data[$i]['orderbook_units'][3]['bid_price'],

                        'buy4_amount' => $upbit_json_data[$i]['orderbook_units'][4]['bid_size'],
                        'buy4_price' => $upbit_json_data[$i]['orderbook_units'][4]['bid_price'],

                        'buy5_amount' => $upbit_json_data[$i]['orderbook_units'][5]['bid_size'],
                        'buy5_price' => $upbit_json_data[$i]['orderbook_units'][5]['bid_price'],
                    ]);
            }
        }
        $api_exchanges = Api_exchange::get();

        $user_krw = auth()->user()->KRW;
        $user_krw_using = auth()->user()->KRW_using;
        $user_btc = auth()->user()->BTC;
        $user_btc_using = auth()->user()->BTC_using;

        $json_data = [
            'api_data' => $api_exchanges,
            'user_krw' => $user_krw,
            'user_krw_using' => $user_krw_using,
            'user_btc' => $user_btc,
            'user_btc_using' => $user_btc_using,
        ];

        return $json_data;
    }
    // 처리
    public function swap_complete()
    {
    }
}
