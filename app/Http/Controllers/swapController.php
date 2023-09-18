<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


// 모델
use App\Models\Api_exchange;
use App\Models\Users_txid;
use App\Models\User;

// 컨트롤러
use App\Http\Controllers\CommonController;

class swapController extends Controller
{



    // 스왑 원화->코인
    public function swap_krw_to_coin_index()
    {
        $CommonController = new CommonController();
        $price_descs = $CommonController->price_desc();

        return view('swap.index', ['swap_to' => 'coin', 'type' => 'buy', 'korean_type' => "매수", 'price_descs' => $price_descs]);
    }

    // 스왑 원화->코인
    public function swap_coin_to_krw_index()
    {
        $CommonController = new CommonController();
        $price_descs = $CommonController->price_desc();

        return view('swap.index', ['swap_to' => 'krw', 'type' => 'sell', 'korean_type' => "매도", 'price_descs' => $price_descs]);
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
        $api_exchanges = Api_exchange::orderby('sell1_price', 'desc')->get();

        $user_krw = auth()->user()->KRW;
        $user_krw_using = auth()->user()->KRW_using;
        $user_btc = auth()->user()->BTC;
        $user_btc_using = auth()->user()->BTC_using;

        $user_eth = auth()->user()->ETH;
        $user_eth_using = auth()->user()->ETH_using;

        $user_bch = auth()->user()->BCH;
        $user_bch_using = auth()->user()->BCH_using;

        $user_etc = auth()->user()->ETC;
        $user_etc_using = auth()->user()->ETC_using;

        $user_eos = auth()->user()->EOS;
        $user_eos_using = auth()->user()->EOS_using;

        $user_xrp = auth()->user()->XRP;
        $user_xrp_using = auth()->user()->XRP_using;

        $user_ada = auth()->user()->ADA;
        $user_ada_using = auth()->user()->ADA_using;

        $user_doge = auth()->user()->DOGE;
        $user_doge_using = auth()->user()->DOGE_using;


        $json_data = [
            'api_data' => $api_exchanges,
            'user_krw' => $user_krw,
            'user_krw_using' => $user_krw_using,
            'user_btc' => $user_btc,
            'user_btc_using' => $user_btc_using,

            'user_eth' => $user_eth,
            'user_eth_using' => $user_eth_using,
            'user_bch' => $user_bch,
            'user_bch_using' => $user_bch_using,
            'user_etc' => $user_etc,
            'user_etc_using' => $user_etc_using,
            'user_eos' => $user_eos,
            'user_eos_using' => $user_eos_using,
            'user_xrp' => $user_xrp,
            'user_xrp_using' => $user_xrp_using,
            'user_ada' => $user_ada,
            'user_ada_using' => $user_ada_using,
            'user_doge' => $user_doge,
            'user_doge_using' => $user_doge_using,
        ];

        return $json_data;
    }
    // 처리
    public function swap_button_ajax(Request $request)
    {
        $type = $request->input('type');
        $coin = $request->input('coin');
        $price = $request->input('price');
        $amount = $request->input('amount');

        if ($price <= 0 || $amount <= 0 || !is_numeric($price) || !is_numeric($amount)) {
            return response('수량과 가격은 숫자만 입력 할 수 있으며, 0이하는 입력 할 수 없습니다.', 400);
        }

        if ($type != "sell" && $type != "buy") {
            return response('옳바른 값을 입력 해주세요.', 400);
        }

        $validator = Validator::make(
            ['number' => $amount], // 검증할 데이터와 키를 설정
            ['number' => ['numeric', 'regex:/^\d+(\.\d{1,4})?$/']] // 규칙 설정
        );

        if ($validator->fails()) {
            return response('소숫점 5자리 이상은 허용하지 않습니다.', 400);
        }




        $api_data = $this->price_ajax();

        $user_pk = auth()->user()->id;
        $user_id = auth()->user()->user_id;
        $user_krw = auth()->user()->KRW;
        $user_coin = auth()->user()->$coin;


        if (!$user_coin && $user_coin != 0) {
            return response('현재 입력하신 코인이 없습니다.', 400);
        }


        for ($i = 0; $i < count($api_data['api_data']); $i++) {
            if ($api_data['api_data'][$i]['type'] == $coin) {
                if ($type == "buy") {
                    // 원화->코인 스왑
                    $korean_type = "구매";

                    if ($price < $api_data['api_data'][$i]['sell0_price']) {
                        return response('가격이 변동되어 스왑되지 않았습니다. 재시도하여주세요.', 400);
                    }

                    $trades_price = $api_data['api_data'][$i]['sell0_price'];

                    $final_price = $trades_price * $amount;
                    if ($final_price > $user_krw) {
                        return response('보유하신 원화가 부족합니다.', 400);
                    }
                    $final_price = -$final_price;
                } else if ($type == "sell") {
                    $korean_type = "판매";
                    // 코인->원화 스왑
                    if ($price > $api_data['api_data'][$i]['buy0_price']) {
                        return response('가격이 변동되어 스왑되지 않았습니다. 재시도하여주세요.', 400);
                    }

                    if ($amount > $user_coin) {
                        return response('보유하신 ' . $coin . '가 부족합니다.', 400);
                    }
                    $trades_price = $api_data['api_data'][$i]['buy0_price'];
                    $final_price = $amount * $trades_price;
                    $amount = -$amount;
                } else {
                    return response('옳바른 값을 입력 해주세요.', 400);
                }

                if (abs($final_price) < 5000) {
                    return response('스왑기능은 5,000원 이상부터 체결이 가능합니다.', 400);
                }


                Users_txid::create([
                    'users_pk' => $user_pk, // 유저 기본키 값
                    'user_id' => $user_id, // 유저 아이디 값
                    'coin' => $coin, // 코인 종류(BTC, ETH, BCH등등)
                    'type' => '스왑(' . $korean_type . ')', // 종류(입금, 출금, 매수, 매도)
                    'trades_volume' => $amount, // 거래수량
                    'trades_price' => $trades_price, // 거래단가
                    'trades_total_price' => $final_price, // 거래금액
                    'fee' => 0, // 수수료
                    'settlement_amount' => $final_price, // 정산금액 (수수료 반영)
                ]);

                $user = Auth::user();
                $user->$coin = $user_coin + $amount;
                $user->KRW = $user_krw + $final_price;
                $user->save();




                return "정상적으로 스왑되었습니다.";
            }
        }

        return response('코인명을 찾을 수 없습니다.', 400);
    }
}
