<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;





use App\Models\Api_exchange;


class CommonController extends Controller
{
    //


    public function price_desc()
    {
        $api_exchanges = Api_exchange::select('type', 'korean_name')->orderby('sell1_price', 'desc')->get();

        return $api_exchanges;
    }
}
