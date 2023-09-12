<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Mail\Email_register;


class registerController extends Controller
{
    //

    public function register_get()
    {
        // 로그인되어있으면 메인화면으로 
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        return view('auth.register');
    }

    public function user_id_check(Request $request)
    {
        // 로그인 되어 있으면
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        $user_id = $request->input('user_id');

        if (empty($user_id) || $user_id == "") {
            return response('빈 값을 입력하였습니다.', 400);
        }

        $user_id_strlen =   mb_strlen($user_id, 'UTF-8');

        if ($user_id_strlen >= 20) {
            return response('20글자 이내로만 입력할 수 있습니다.', 422);
        }

        $user = User::where('user_id', $user_id)->first();
        if ($user) {
            return response('중복된 아이디가 있습니다.', 409);
        } else {
            return '사용가능한 아이디';
        }
    }


    public function nickname_check(Request $request)
    {
        // 로그인 되어 있으면
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        $nickname = $request->input('nickname');




        if (empty($nickname) || $nickname == "") {
            return response('빈 값을 입력하였습니다.', 400);
        }



        $nickname_strlen = mb_strlen($nickname, 'UTF-8');

        if ($nickname_strlen > 5) {
            return response('5글자 이내로만 입력할 수 있습니다.', 422);
        }

        if (Str::contains($nickname, "관리자")) {
            return response('관리자가 포함된 닉네임은 사용 할 수 없습니다.', 409);
        }

        $user = User::where('nickname', $nickname)->first();
        if ($user) {
            return response('중복된 닉네임이 있습니다.', 409);
        } else {
            return '사용가능한 닉네임';
        }
    }

    public function register_post(Request $request)
    {
        // 로그인 되어 있으면
        if (Auth::check()) {
            return redirect()->route('welcome');
        }

        $validation = $request->validate([
            'user_id' => 'required|min:1|max:20|unique:users|string',

            'nickname' => [
                'required',
                'min:1',
                'max:5',
                'unique:users',
                'string',
                function ($attribute, $value, $fail) {
                    if (strpos($value, '관리자') !== false) {
                        $fail('닉네임에는 "관리자"를 포함할 수 없습니다.');
                    }
                },
            ],

            'password' => 'required|min:1|max:256|confirmed',
        ]);

        User::create([
            'user_id' => $validation['user_id'],
            'nickname' =>  $validation['nickname'],
            'password' => Hash::make($validation['password']),
        ]);
        return '회원가입성공';
    }

    public function send_email_code(Request $request)
    {
        $email = auth()->user()->email;
        $user_id = auth()->user()->user_id;
        $user_sql = User::where('user_id', $user_id)->first();
        if ($email) {
            $request_email = $email;
        } else {
            $request_email = $request->input('email');

            if (!$request_email || empty($request_email)) {
                return response('이메일에 아이디를 입력하여주세요.', 409);
            }

            if (strpos($request_email, '@') !== false) {
                return response('@naver.com을 제거하고 네이버 아이디만 입력하여주세요.', 409);
            }

            $request_email .= "@naver.com";

            $request_email_strlen =   mb_strlen($request_email, 'UTF-8');

            if ($request_email_strlen >= 31) {
                return response('20글자 이내로만 입력할 수 있습니다.', 422);
            }


            $email_check = User::where('email', $request_email)->first();
            if ($email_check) {
                return response('중복된 아이디가 있습니다.', 422);
            }


            $user_sql->email = $request_email;
            $user_sql->save();
        }

        $email_code = auth()->user()->email_code;


        if (!empty($email_code) && $email_code) {
            $code = $email_code;
        } else {
            $code = Str::random(8);
        }

        $user_sql->email_code = $code;
        $user_sql->save();

        $details = [
            'subject' => '[레트로M] 이메일 인증번호',
            'code' => $code,
        ];

        Mail::to($request_email)->send(new Email_register($details));

        $return_message = "{$request_email}로 인증번호를 전송하였습니다.";

        return $return_message;
    }

    public function send_email_code_check(Request $request)

    {
        $request_code = $request->input('code');

        $user_id = auth()->user()->user_id;
        $user_sql = User::where('user_id', $user_id)->first();

        if (!$user_sql->email_code || empty($user_sql->email_code)) {
            return response('인증코드를 발급받지 않았습니다.', 400);
        }

        if ($user_sql->email_code == $request_code) {
            $user_sql->email_authentication = 1;
            $user_sql->save();
            return "인증코드가 확인되었습니다.";
        } else {
            return response('인증코드가 옳바르지 않습니다.', 400);
        }
    }
}
