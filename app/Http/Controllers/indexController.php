<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Board_category;
use App\Models\Board_title_category;
use App\Models\Board;

use Illuminate\Support\Facades\Auth;


class indexController extends Controller
{
    public function index()
    {
        $coininfo_board_sqls = Board::select('id', 'title_categories_id', 'title', 'created_at')
            ->where('board_categories_id', 1)
            ->where('ban', 0)
            ->where('delete', 0)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $free_board_sqls =  Board::select('id', 'title_categories_id', 'title', 'created_at')
            ->where('board_categories_id', 2)
            ->where('ban', 0)
            ->where('delete', 0)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $mining_board_sqls = Board::select('id', 'title_categories_id', 'title', 'created_at')
            ->where('board_categories_id', 3)
            ->where('ban', 0)
            ->where('delete', 0)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $pnl_sqls = Board::select('id', 'title_categories_id', 'title', 'created_at')
            ->where('board_categories_id', 4)
            ->where('ban', 0)
            ->where('delete', 0)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $registerationgreeting_sqls = Board::select('id', 'title_categories_id', 'title', 'created_at')
            ->where('board_categories_id', 5)
            ->where('ban', 0)
            ->where('delete', 0)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $notice_sqls = Board::select('id', 'title_categories_id', 'title', 'created_at')
            ->where('board_categories_id', 6)
            ->where('ban', 0)
            ->where('delete', 0)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        return view('welcome', ['coininfo_board_sqls' => $coininfo_board_sqls, 'free_board_sqls' => $free_board_sqls, 'mining_board_sqls' => $mining_board_sqls, 'pnl_sqls' => $pnl_sqls, 'registerationgreeting_sqls' => $registerationgreeting_sqls, 'notice_sqls' => $notice_sqls]);
    }
}
