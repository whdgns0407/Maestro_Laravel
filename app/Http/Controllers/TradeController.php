<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TradeController extends Controller
{
    //

    public function index(Request $request, $coin)
    {
        return view('trade.index');
    }
}
