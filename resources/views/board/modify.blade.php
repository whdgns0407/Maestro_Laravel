<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>게시글 수정</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="/navereditor/js/HuskyEZCreator.js" charset="utf-8"></script>
    @include('layouts.header')
</head>

<body>
    <table class="table">
        <tr>
            <td colspan="2" style="text-align:center;">게시글수정</td>
        </tr>
        <tr>
            @if ($board_title_catetories->count() > 0)
                <td style="width:20%;">
                    <select class="form-control" id="category" name="category">
                        @foreach ($board_title_catetories as $board_title_category)
                            <option value="{{ $board_title_category->id }}"
                                @if ($board_title_category->id == $board_sql->title_categories_id) selected @endif>
                                {{ $board_title_category->title_name }}
                            </option>
                        @endforeach
                    </select>
                </td>
                @php
                    $title_colspan = 1;
                @endphp
            @else
                <select class="form-control" id="category" name="category" style="display:none;">
                    <option value="False">False</option>
                </select>
                @php
                    $title_colspan = 2;
                @endphp
            @endif
            <td style="width:80%;" colspan="{{ $title_colspan }}">
                <input type="text" class="form-control" id="title" name="title" style="width:100%;"
                    placeholder="제목을 입력하여주세요." value="{{ $board_sql->title }}" required>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <textarea id="content" name="content" rows="20" style="width:100%;" required>{!! $board_sql->content !!}</textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="button" class="btn btn-primary" style="width:100%; height:100%;"
                    id="photo_upload">사진첨부</button>
                <input type="file" id="fileInput" style="display: none;" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <button type="button" class="btn btn-primary" style="width:100%; height:100%;"
                    id="write_post">수정하기</button>
            </td>
        </tr>
    </table>
    <script>
        $(document).ready(function() {
            $('#photo_upload').on('click', function() {
                $('#fileInput').click();
            });

            $("#fileInput").on("change", function() {
                var file = this.files[0]; // 첨부된 첫 번째 파일을 가져옵니다.
                var url = "{{ route('img_upload_post') }}";
                var formData = new FormData();
                formData.append("image", file);

                $.ajax({
                    url: url, // 서버 엔드포인트 주소를 입력하십시오.
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response.url);
                        var imgTag = "<img src='" + response.url + "'>";
                        // 이 방법은 스마트 에디터에 따라 변경되며, 선택된 영역이나 현재 커서 위치에 이미지를 삽입할 수 있어야 합니다.
                        addToEditor('content', imgTag);
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseJSON.error);
                    },
                });
            });





            var oEditors = [];
            nhn.husky.EZCreator.createInIFrame({
                oAppRef: oEditors,
                elPlaceHolder: "content",
                sSkinURI: "/navereditor/SmartEditor2Skin.html",
                fCreator: "createSEditor2",
                htParams: {
                    bUseToolbar: true,
                    fOnBeforeUnload: function() {

                    }
                },
                fOnAppLoad: function() {

                },
                fCreator: "createSEditor2"
            });

            function addToEditor(editorId, content) {
                var editor = oEditors.getById[editorId];
                if (editor) {
                    editor.exec("PASTE_HTML", [content]);
                }
            }





            $("#write_post").click(function() {
                // 서버로 데이터를 보내고 응답을 받아오는 Ajax 요청

                category = $("#category").val();
                title = $("#title").val();
                content = oEditors.getById["content"].getIR();


                $.ajax({
                    type: "POST", // GET 또는 POST 등 요청 방식 지정
                    url: "{{ route('board_modify_post', ['board_id' => $board_sql->id]) }}", // 실제 서버 엔드포인트 URL
                    data: {
                        category: category,
                        title: title,
                        content: content,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // 서버로부터 응답이 성공적으로 돌아왔을 때의 처리
                        window.location.href =
                            "{{ route('board_view', ['board_id' => $board_sql->id]) }}";
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            });
        })
    </script>
</body>

</html>
