<?php

namespace App\Http\Controllers;

use App\Models\Customer_category;
use App\Models\Customer_reply;
use App\Models\Customer;


use Ramsey\Uuid\Uuid;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class customerController extends Controller
{
    public function write_get(Request $request)
    {
        $user_id = auth()->user()->user_id;
        $email_authentication = auth()->user()->email_authentication;

        if (empty($email_authentication)) {
            return view('customer.email_register');
        }

        $customer_categories = $this->category();
        $lists = $this->list();
        return view('customer.write', ['customer_categories' => $customer_categories, 'lists' => $lists]);
    }



    public function write_post(Request $request)
    {
        $category = $request->input('category');
        $content = $request->input('content');

        if (mb_strlen($content, 'UTF-8') > 500) {
            $customer_categories = $this->category();
            $lists = $this->list();
            session()->flash('message', '500글자 이내로 입력하여주세요.');
            session()->flash('content', $content);
            return view('customer.write', ['customer_categories' => $customer_categories, 'lists' => $lists]);
        }

        $uuid = Uuid::uuid4()->toString();
        $user_id = auth()->user()->user_id;

        $category_get = Customer_category::where([
            ['id', $category],
            ['use', 1]
        ])->first();

        if (!$category_get || empty($category_get)) {
            $customer_categories = $this->category();
            $lists = $this->list();
            session()->flash('message', '카테고리값이 없습니다.');
            return view('customer.write', ['customer_categories' => $customer_categories, 'lists' => $lists]);
        }

        $customer_write = new Customer([
            'uuid' => $uuid,
            'user_id' => $user_id,
            'type' => $category,
            'title' => $category_get->title,
            'content' => $content,
        ]);
        $customer_write->save();

        $customer_categories = $this->category();
        $lists = $this->list();
        session()->flash('message', '문의가 작성되었습니다.');
        return view('customer.write', ['customer_categories' => $customer_categories, 'lists' => $lists]);
    }


    public function view($uuid)
    {
        $user_id = auth()->user()->user_id;
        $admin = auth()->user()->admin;

        if ($admin == 1) {
            $view_get = Customer::where([
                ['uuid', $uuid]
            ])->orderBy('created_at', 'desc')->first();
        } else {
            $view_get = Customer::where([
                ['user_id', $user_id], ['uuid', $uuid]
            ])->orderBy('created_at', 'desc')->first();
        }

        if (!$view_get || empty($view_get)) {
            abort(404);
        }

        $customer_replies = Customer_reply::where('customers_uuid', $uuid)->first();

        return view('customer.view', ['view_get' => $view_get, 'uuid' => $uuid, 'customer_replies' => $customer_replies]);
    }

    public function list()
    {
        $user_id = auth()->user()->user_id;
        $lists_sql = Customer::where([
            ['user_id', $user_id],
        ])->orderBy('id', 'desc')->get();

        return $lists_sql;
    }

    public function category()
    {
        $categories_sql = Customer_category::where('use', 1)->get();
        return $categories_sql;
    }
}
