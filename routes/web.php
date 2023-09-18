<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// 로그인한 사용자만
Route::middleware(['auth'])->group(function () {

    // 이메일 인증번호 보내기
    Route::post('/register/send_email_code', [App\Http\Controllers\Auth\registerController::class, 'send_email_code'])->name('customer_send_email_code');

    // 이메일 인증 확인
    Route::post('/register/send_email_check_code', [App\Http\Controllers\Auth\registerController::class, 'send_email_code_check'])->name('customer_send_email_check_code');

    // 고객센터 get
    Route::get('/customer/write', [App\Http\Controllers\customerController::class, 'write_get'])->name('customer_write_get');

    // 고객센터 글쓰기
    Route::post('/customer/write', [App\Http\Controllers\customerController::class, 'write_post'])->name('customer_write_post');

    // 고객문의 팝업창 띄워주기
    Route::get('/customer/view/{uuid}', [App\Http\Controllers\customerController::class, 'view'])->name('customer_view');

    // 게시글 쓰기 (get)
    Route::get('/board/write/{board_name}', [App\Http\Controllers\boardController::class, 'board_write_get'])->name('board_write_get');

    // 게시글 쓰기 (post)
    Route::post('/board/write/{board_name}', [App\Http\Controllers\boardController::class, 'board_write_post'])->name('board_write_post');

    // 게시글 삭제하기
    Route::get('/board/delete/{board_id}', [App\Http\Controllers\boardController::class, 'delete'])->name('board_delete');

    // 게시글 수정하기 (get)
    Route::get('/board/modify/{board_id}', [App\Http\Controllers\boardController::class, 'modify_get'])->name('board_modify_get');

    // 게시글 수정하기 업데이트 (get)
    Route::post('/board/modify/{board_id}', [App\Http\Controllers\boardController::class, 'modify_post'])->name('board_modify_post');

    // 댓글 작성하기
    Route::post('/board/comment_write/{board_id}', [App\Http\Controllers\boardController::class, 'comment_write'])->name('comment_write');

    // 댓글 수정하기

    // 댓글 삭제하기
    Route::post('/board/comment_delete', [App\Http\Controllers\boardController::class, 'comment_delete'])->name('comment_delete');


    // 사진 업로드 post
    Route::post('/img_upload', [App\Http\Controllers\imgController::class, 'upload_post'])->name('img_upload_post');


    // 코인 -> KRW 스왑 INDEX
    Route::get('/swap/coin_to_krw', [App\Http\Controllers\swapController::class, 'swap_coin_to_krw_index'])->name('swap_coin_to_krw');

    // KRW -> 코인 스왑 INDEX
    Route::get('/swap/krw_to_coin', [App\Http\Controllers\swapController::class, 'swap_krw_to_coin_index'])->name('swap_krw_to_coin');

    // SWAP ajax (코인 시세, 유저정보)
    Route::get('/swap/price_ajax', [App\Http\Controllers\swapController::class, 'price_ajax'])->name('swap_price_ajax');

    // SWAP 버튼 클릭
    Route::post('/swap/button_ajax', [App\Http\Controllers\swapController::class, 'swap_button_ajax'])->name('swap_button_ajax');

    // 관리자
    Route::get('/admin/customer/{status}', [App\Http\Controllers\admin\customerController::class, 'get'])->name('admin_customer_get');

    // 관리자 답변달기
    Route::post('/admin/customer/write/{uuid}', [App\Http\Controllers\admin\customerController::class, 'write'])->name('admin_customer_write');
});

// 게시글 리스트 보기
Route::get('/board/list/{board_name}', [App\Http\Controllers\boardController::class, 'board_list_get'])->name('board_list_get');

// 게시글 보기
Route::get('/board/view/{board_id}', [App\Http\Controllers\boardController::class, 'board_view'])->name('board_view');

// 이미지보기
Route::get('/img/view/{uuid}', [App\Http\Controllers\imgController::class, 'img_view'])->name('img_view');




// 메인창 띄우기
Route::get('/', [App\Http\Controllers\indexController::class, 'index'])->name('welcome');


// 거래소 (trade)
Route::get('/trade/{coin}', [App\Http\Controllers\TradeController::class, 'index'])->name('trade_index');

// 회원가입 get요청
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register_get'])->name('register_get');

// 회원가입 아이디 체크
Route::post('/register/user_id/check', [App\Http\Controllers\Auth\RegisterController::class, 'user_id_check'])->name('register_user_id_check');

// 회원가입 닉네임 체크
Route::post('/register/nickname/check', [App\Http\Controllers\Auth\RegisterController::class, 'nickname_check'])->name('register_nickname_check');

// 회원가입 post요청
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register_post'])->name('register_post');


// 로그인 get요청
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'login_get'])->name('login_get');

// 로그인 post요청
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login_post'])->name('login_post');

// 로그아웃 get요청
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
