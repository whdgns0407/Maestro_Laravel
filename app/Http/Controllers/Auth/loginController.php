<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class loginController extends Controller
{
    public function login_get()
    {
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        return view('auth.login');
    }


    public function login_post(Request $request)
    {

        // 로그인 되어 있으면
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        $id = $request->input('id');
        $password = $request->input('password');

        $credentials = [
            'user_id' => $id,
            'password' => $password,
        ];

        $validationRules = [
            'user_id' => 'required',
            'password' => 'required',
        ];

        $validation = Validator::make($credentials, $validationRules);

        $remember = "on";
        if (Auth::attempt($credentials, $remember)) {
            return redirect()->route('welcome');
        } else {
            return redirect()->route('login_get')->with('error', '아이디또는 비밀번호를 확인하여주세요.');
        }
    }


    public function logout()
    {
        Auth::logout();

        return redirect()->route('welcome');
    }
}
