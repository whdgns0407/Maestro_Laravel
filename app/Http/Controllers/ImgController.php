<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;



use App\Models\Photo;


class imgController extends Controller
{
    //
    public function upload_get(Request $request)
    {
        return "제공하지 않음";
    }


    public function upload_post(Request $request)
    {

        $file = $request->file('image');
        $user_id = auth()->user()->user_id;

        if (!$file) {
            return response()->json(['error' => '파일이 첨부되지 않았습니다.']);
        }

        $fileName = $file->getClientOriginalName();
        $fileExtension = $request->file('image')->getClientOriginalExtension();
        $mimeType = $request->file('image')->getMimeType();
        $fileSize = $request->file('image')->getSize();


        if (strlen($fileName) > 99) {
            return response()->json(['error' => '파일 글자는 100글자 이내로만 업로드 가능합니다.'], 400);
        }

        if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif', 'image/bmp', 'image/webp']) || !in_array($fileExtension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp'])) {
            return response()->json(['error' => '이미지 파일이 아닙니다.'], 400);
        }

        if ($fileSize > 20000000) {
            return response()->json(['error' => '파일 크기가 20MB를 초과했습니다.'], 400);
        }

        $uuid = Uuid::uuid4();

        $save_result = Storage::disk('local')->putFileAs('', $file, $uuid);

        if ($save_result) {
        } else {
            return response()->json(['error' => '업로드 실패 관리자에게 문의하여주세요.'], 400);
        }

        $insert_img_sql = new Photo;
        $insert_img_sql->user_id = $user_id;
        $insert_img_sql->filename = $fileName;
        $insert_img_sql->uuid = $uuid;
        $insert_img_sql->save();

        $response = [
            'url' => route('img_view', ['uuid' => $uuid]),
        ];

        return response()->json($response);
    }


    public function img_view($uuid)
    {
        $filePath = $uuid;
        $hasData = Photo::where('uuid', $uuid)->exists();

        if (!$hasData) {
            abort(404);
        }

        if (!Storage::disk('local')->exists($filePath)) {
            abort(404);
        }

        $file  = Storage::disk('local')->get($filePath);
        $mimeType = Storage::disk('local')->mimeType($filePath);

        $response = new Response($file, 200);
        $response->header('Content-Type', $mimeType);

        return $response;
    }
}
