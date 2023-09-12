<?php

namespace App\Http\Controllers;

use HTMLPurifier;
use HTMLPurifier_Config;

use App\Models\Board_category;
use App\Models\Board_title_category;
use App\Models\Comment;
use App\Models\Board;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class boardController extends Controller
{

    public function board_view(Request $request, $board_id)
    {
        $board_view_sql = Board::where('id', $board_id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->first();

        if (!$board_view_sql) {
            abort(404);
        }

        $board_category_sql = Board_category::where('id', $board_view_sql->board_categories_id)
            ->first();

        if (!$board_category_sql) {
            return "폐쇄된 카테고리입니다.";
        }

        $comment_sqls = Comment::where('board_id', $board_id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->get();



        return view('board.view', ['board_id' => $board_id, 'board_view_sql' => $board_view_sql, 'board_category_sql' => $board_category_sql, 'comment_sqls' => $comment_sqls,]);
    }




    public function board_list_get(Request $request, $board_name)
    {
        $board_category_sql = Board_category::where('english_name', $board_name)->first();

        if (!$board_category_sql) {
            abort(404);
        }

        $board_list_sqls = Board::where('board_categories_id', $board_category_sql->id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(15, ['*'], 'page');

        return view('board.index', ['board_category_sql' => $board_category_sql, 'board_list_sqls' => $board_list_sqls, 'board_name' => $board_name]);
    }


    public function board_write_get(Request $request, $board_name)
    {
        $board_category_sql = Board_category::where('english_name', $board_name)->first();

        if (!$board_category_sql) {
            abort(404);
        }

        $admin = auth()->user()->admin;
        if ($board_category_sql->admin_write == 1 && $admin != 1) {
            abort(403);
        }

        $board_title_cateory_sql = Board_title_category::where('boards_id', $board_category_sql->id)->get();

        return view('board.write', ['board_category_sql' => $board_category_sql, 'board_name' => $board_name, 'board_title_catetories' => $board_title_cateory_sql]);
    }


    public function board_write_post(Request $request, $board_name)
    {
        $category = $request->input('category');
        $title = $request->input('title');
        $content = $request->input('content');

        $user_id = auth()->user()->user_id;
        $nick_name = auth()->user()->nickname;
        $admin = auth()->user()->admin;

        if (empty($category) || $category == "" || empty($title) || $title == "" || empty($content) || $content == "") {
            return response('카테고리, 제목, 내용을 반드시 한글자 이상 입력하여주세요.', 400);
        }

        $title_strlen =   mb_strlen($title, 'UTF-8');

        if ($title_strlen >= 50) {
            return response('제목은 50글자 이내로만 입력할 수 있습니다.', 422);
        }

        $board_category_sql = Board_category::where('english_name', $board_name)->first();

        if (!$board_category_sql) {
            return response('게시판을 찾을 수 없습니다.', 400);
        }

        if ($board_category_sql->admin_write == 1 && $admin != 1) {
            return response('관리자만 접근가능합니다.', 400);
        }

        if ($category != "False") {
            $board_title_cateory_sql = Board_title_category::where('boards_id', $board_category_sql->id)
                ->where('id', $category)
                ->first();

            if (!$board_title_cateory_sql) {
                return response('카테고리를 찾을 수 없습니다.', 400);
            }

            $title_categories_id = $category;
            $title_categories_name = $board_title_cateory_sql->title_name;
        } else {
            $title_categories_id = NULL;
            $title_categories_name = NULL;
        }
        $config = HTMLPurifier_Config::createDefault();

        $config->set('HTML.SafeObject', true);
        $purifier = new HTMLPurifier($config);

        // 사용자 입력 필터링
        $cleanContent = $purifier->purify($content);

        $board_write = new Board();
        $board_write->board_categories_id = $board_category_sql->id;
        $board_write->board_categories_name = $board_category_sql->korean_name;
        $board_write->user_id = $user_id;
        $board_write->nickname =  $nick_name;
        $board_write->title_categories_id =  $title_categories_id;
        $board_write->title_categories_name = $title_categories_name;
        $board_write->title = $title;
        $board_write->content = $cleanContent;
        $board_write->delete = 0;
        $board_write->ban = 0;
        $board_write->hit = 0;
        $board_write->save();

        return "저장됨";
    }

    public function delete($board_id)
    {
        $user_id = auth()->user()->user_id;
        $admin =  auth()->user()->admin;
        $board_sql = Board::where('id', $board_id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->first();

        if (!$board_sql) {
            abort(404);
        }

        if ($board_sql->user_id != $user_id) {
            if ($admin != 1) {
                return response('정상적인 경로가 아닙니다. 정상적인 루트임에도 불구하고 이 메시지가 계속 뜰 경우 관리자에게 문의하여주세요.', 400);
            }
        }

        $board_sql->delete = 1;
        $board_sql->save();

        return "삭제 완료";
    }


    public function modify_get($board_id)
    {
        $user_id = auth()->user()->user_id;

        $board_sql = Board::where('id', $board_id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->where('user_id', $user_id)
            ->first();

        if (!$board_sql) {
            return response('정상적인 경로가 아닙니다. 정상적인 루트임에도 불구하고 이 메시지가 계속 발생할 경우 관리자에게 문의하여주세요.', 400);
        }

        $board_category_sql = Board_category::where('id', $board_sql->board_categories_id)->first();

        if (!$board_category_sql) {
            return response('카테고리가 없습니다. 이 메시지가 계속 발생할 경우 관리자에게 문의하여주세요.', 400);
        }

        $admin = auth()->user()->admin;
        if ($board_category_sql->admin_write == 1 && $admin != 1) {
            return response('관리자만 접근이 가능합니다.', 400);
        }

        $board_title_cateory_sql = Board_title_category::where('boards_id', $board_category_sql->id)->get();

        return view('board.modify', ['board_category_sql' => $board_category_sql, 'board_title_catetories' => $board_title_cateory_sql, 'board_sql' => $board_sql]);
    }


    public function modify_post(Request $request, $board_id)
    {
        $user_id = auth()->user()->user_id;

        $board_sql = Board::where('id', $board_id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->where('user_id', $user_id)
            ->first();

        if (!$board_sql) {
            return response('정상적인 경로가 아닙니다. 정상적인 루트임에도 불구하고 이 메시지가 계속 발생할 경우 관리자에게 문의하여주세요.', 400);
        }


        $category = $request->input('category');
        $title = $request->input('title');
        $content = $request->input('content');

        $admin = auth()->user()->admin;

        if (empty($category) || $category == "" || empty($title) || $title == "" || empty($content) || $content == "") {
            return response('카테고리, 제목, 내용을 반드시 한글자 이상 입력하여주세요.', 400);
        }

        $title_strlen =   mb_strlen($title, 'UTF-8');

        if ($title_strlen >= 50) {
            return response('제목은 50글자 이내로만 입력할 수 있습니다.', 422);
        }



        $board_category_sql = Board_category::where('id', $board_sql->board_categories_id)->first();

        if (!$board_category_sql) {
            return response('게시판을 찾을 수 없습니다.', 400);
        }

        if ($board_category_sql->admin_write == 1 && $admin != 1) {
            return response('관리자만 접근가능합니다.', 400);
        }

        if ($category != "False") {
            $board_title_cateory_sql = Board_title_category::where('boards_id', $board_category_sql->id)
                ->where('id', $category)
                ->first();

            if (!$board_title_cateory_sql) {
                return response('카테고리를 찾을 수 없습니다.', 400);
            }

            $title_categories_id = $category;
            $title_categories_name = $board_title_cateory_sql->title_name;
        } else {
            $title_categories_id = NULL;
            $title_categories_name = NULL;
        }
        $config = HTMLPurifier_Config::createDefault();

        $config->set('HTML.SafeObject', true);
        $purifier = new HTMLPurifier($config);

        // 사용자 입력 필터링
        $cleanContent = $purifier->purify($content);

        $board_sql->title_categories_id = $title_categories_id;
        $board_sql->title_categories_name = $title_categories_name;
        $board_sql->title = $title;
        $board_sql->content = $cleanContent;
        $board_sql->save();

        return "저장됨";
    }




    public function comment_write(Request $request, $board_id)
    {
        $request_comment = $request->input('comment');

        if (empty($request_comment) || !$request_comment) {
            return response('댓글내용을 입력하여주세요.', 400);
        }


        $board_view_sql = Board::where('id', $board_id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->first();

        if (!$board_view_sql) {
            return response('게시글이 없습니다.', 400);
        }


        $user_id = auth()->user()->user_id;
        $nickname = auth()->user()->nickname;
        $comment = new Comment();
        $comment->board_id = $board_id;
        $comment->user_id = $user_id;
        $comment->nickname = $nickname;
        $comment->body = $request_comment;
        $comment->delete = 0;
        $comment->ban = 0;
        $comment->save();
    }

    public function comment_delete(Request $request)
    {
        $user_id = auth()->user()->user_id;
        $request_comment_id = $request->input('comment_id');

        $comment_sql = Comment::where('id', $request_comment_id)
            ->where('ban', 0)
            ->where('delete', 0)
            ->where('user_id', $user_id)
            ->first();

        if (!$comment_sql) {
            return response('정상적인 경로가 아닙니다. 정상적인 루트임에도 불구하고 이 메시지가 계속 뜰 경우 관리자에게 문의하여주세요.', 400);
        }

        $comment_sql->delete = 1;
        $comment_sql->save();
    }
}
