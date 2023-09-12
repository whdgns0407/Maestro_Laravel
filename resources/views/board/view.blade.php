<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        [{{ $board_view_sql->board_categories_name }}] -
        @if (!empty($board_view_sql->title_categories_name))
            {{ $board_view_sql->title_categories_name }} -
        @endif
        {{ $board_view_sql->title }}
    </title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .post {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            overflow: hidden;
            max-width: 100%;
        }

        .post img {
            width: 100%;
            height: auto;
        }

        .post h2 {
            margin-top: 0;
        }

        .comments {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }

        .comment {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        .comment p {
            margin: 0;
        }

        .comment-form,
        .reply-form {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reply-form {
            margin-left: 20px;
            background-color: #f0f0f0;
        }

        textarea {
            width: 80%;
            height: 50px;
        }

        button[type="submit"] {
            width: 20%;
            height: 50px;
        }

        .reply-content {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f0f0f0;
            padding-left: 10px;
        }

        .post-actions {
            display: flex;
            justify-content: flex-end;
            /* 오른쪽 정렬 */
            align-items: center;
        }

        .edit-button,
        .delete-button {
            border: none;
            background-color: #f0f0f0;
            padding: 5px 10px;
            cursor: pointer;
        }

        .edit-button {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="post">
        <h2>

            @if (!empty($board_view_sql->title_categories_name))
                [{{ $board_view_sql->title_categories_name }}] -
            @endif
            {{ $board_view_sql->title }}
        </h2>
        <hr>
        <p><strong>작성자 : {{ $board_view_sql->nickname }}</strong> ({{ $board_view_sql->created_at }})</p>
        <hr>
        <div style="word-wrap: break-word;">
            {!! $board_view_sql->content !!}
        </div>
        <hr>
        @if (auth()->check())
            @if (auth()->user()->user_id == $board_view_sql->user_id || auth()->user()->admin == 1)
                <div class="post-actions">
                    <button class="edit-button">수정</button>
                    <script>
                        $(".edit-button").click(function() {
                            window.location.href = "{{ route('board_modify_get', ['board_id' => $board_view_sql->id]) }}";
                        });
                    </script>
                    <button class="delete-button">삭제</button>
                    <script>
                        $(".delete-button").click(function() {
                            if (confirm("정말로 삭제하시겠습니까?")) {
                                $.ajax({
                                    type: "get",
                                    url: "{{ route('board_delete', ['board_id' => $board_view_sql->id]) }}", // 실제 서버 엔드포인트 URL
                                    success: function(response) {
                                        alert(response);
                                        window.opener.location.reload();
                                        window.close();
                                    },
                                    error: function(xhr, status, error) {
                                        alert(xhr.responseText);
                                    }
                                });
                            }
                        });
                    </script>
                </div>
            @endif

        @endif
    </div>
    @if ($board_category_sql->reply_use == 1)
        <div class="comments">

            <!-- 댓글 div
        <div class="reply">
        -->
            <!-- 처음 댓글
            <div class="reply">
                <p><strong>사용자4</strong> (2023-08-25 18:00)</p>
                <p>대댓글 내용 2 <a href="#" onclick="alert('답글기능은 준비중입니다.')">(답글)</a></p>
           
            </div>
        -->

            <!-- 답글 내용 -->

            <!-- 답글 내용 -
            <div class="reply-content">
                <p><strong>ㄴ사용자5</strong> (2023-08-25 17:30)</p>
                <p>답글 내용 1-1</p>
            </div>
            -->
            <!-- 답글내용 입력
            <div class="reply-form">
                <textarea placeholder="답글 입력"></textarea>
                <button type="submit">답글 등록</button>
            </div>
            -->
            <!-- 댓글 div
        </div>
        -->





            <h2>댓글</h2>

            @foreach ($comment_sqls as $comment_sql)
                <div class="reply">
                    <p><strong>{{ $comment_sql->nickname }}</strong> ({{ $comment_sql->created_at }})
                        @if (auth()->check())
                            @if ($comment_sql->user_id == auth()->user()->user_id)
                                - <strong onclick="delete_comment('{{ $comment_sql->id }}')">X</strong>
                            @endif
                        @endif
                    </p>
                    <p>{!! nl2br(e($comment_sql->body)) !!}</p>
                </div>
                <hr>
            @endforeach


            @auth

                <div class="comment-form">
                    <textarea placeholder="댓글 입력" id="comment"></textarea>
                    <button type="submit" id="comment_write_button">댓글 등록</button>
                </div>

                <script>
                    $(document).ready(function() {
                        // 댓글 작성 버튼 클릭 시
                        $('#comment_write_button').click(function() {
                            comment = $("#comment").val();
                            $("#comment").val("");

                            $.ajax({
                                type: "POST",
                                url: "{{ route('comment_write', ['board_id' => $board_id]) }}",
                                data: {
                                    comment: comment,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(success) {
                                    window.location.href =
                                        "{{ route('board_view', ['board_id' => $board_id]) }}";
                                },
                                error: function(xhr, status, error) {
                                    alert(xhr.responseText);
                                }
                            });


                        });
                    });


                    function delete_comment(comment_id) {
                        if (confirm("정말 삭제 하시겠습니까?")) {
                            url = "{{ route('comment_delete') }}";
                            $.ajax({
                                type: "POST",
                                url: url,
                                data: {
                                    comment_id: comment_id,
                                    _token: '{{ csrf_token() }}'
                                },
                                success: function(success) {
                                    window.location.href =
                                        "{{ route('board_view', ['board_id' => $board_id]) }}";
                                },
                                error: function(xhr, status, error) {
                                    alert(xhr.responseText);
                                }
                            });


                        } else {

                        }
                    }
                </script>

            @endauth
        </div>
    @endif
</body>

</html>
