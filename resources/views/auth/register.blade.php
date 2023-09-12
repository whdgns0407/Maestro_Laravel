<html>

<head>
    <title>{{ config('app.name') }} - 회원가입</title>
    <link rel="shortcut icon" type="image/x-icon" href="./icon.ico">
    <meta name="viewport" content="width=device-width", initial-scale="1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        @if (session('error'))
            alert("{{ session('error') }}")
        @endif
    </script>
</head>

<body>
    <div class="container">
        <div class="row vertical-offset-100">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="" method="POST" accept-charset="UTF-8" role="form" class="form-signin"
                            id="user_input_form">
                            <fieldset>
                                <label class="panel-login">
                                    <h3>회원가입</h3>
                                </label>

                                <h4>아이디</h4>
                                <input type="text" class="form-control" id="user_id" name="user_id"
                                    placeholder="사용할 아이디" value="" maxlength="30" required autofocus>
                                <p id="user_id_result"></p>

                                <h4>닉네임</h4>
                                <input type="text" class="form-control" maxlength="30" id="nickname" name="nickname"
                                    placeholder="닉네임을 입력해주세요." required autofocus>
                                <p id="nickname_result"></p>

                                <h4>비밀번호</h4>
                                <input type="password" class="form-control" maxlength="30" id="password"
                                    name="password" placeholder="사용할 비밀번호" required autofocus>
                                <p id="password_result"></p>

                                <h4>비밀번호 확인</h4>
                                <input type="password" class="form-control" maxlength="30" id="password_confirmation"
                                    name="password_confirmation" placeholder="사용할 비밀번호" required autofocus>
                                <p id="password_confirmation_result"></p>

                                @csrf
                                <input class="btn btn-lg btn-secondary btn-block" type="button" value="회원가입하기 »"
                                    id="join_button" name="join_button">
                            </fieldset>
                        </form>
                    </div>
                    <a href="{{ route('login_get') }}"><input class="btn btn-lg btn-secondary btn-block" type="button"
                            id="login_button" value="로그인"></a>
                    <a href="{{ route('welcome') }}"><input class="btn btn-lg btn-secondary btn-block" type="button"
                            value="메인화면"></a>
                </div>
            </div>
        </div>
    </div>
    <script>
        var join_user_id_check = 0;
        var join_nickname_check = 0;
        var join_password_check = 0;


        $("#user_id").focus(function() {
            join_user_id_check = 0;
            $("#user_id_result").html("");
        });

        $("#nickname").focus(function() {
            join_nickname_check = 0;
            $("#nickname_result").html("");
        });

        $("#password").focus(function() {
            join_password_check = 0;
            $("#password_result").html("");
        });

        $("#password_confirmation").focus(function() {
            join_password_check = 0;
            $("#password_confirmation_result").html("");
        });




        function user_id_check() {
            user_id_join = $('#user_id').val();
            $.ajax({
                type: "POST",
                url: "{{ route('register_user_id_check') }}",
                data: {
                    user_id: user_id_join,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $("#user_id_result").html(data);
                    join_user_id_check = 1;
                },
                error: function(xhr, status, error) {
                    $("#user_id_result").html(xhr.responseText);

                    join_user_id_check = 0;
                }
            });
        }



        function nickname_check() {
            nickname_join = $('#nickname').val();
            $.ajax({
                type: "POST",
                url: "{{ route('register_nickname_check') }}",
                data: {
                    nickname: nickname_join,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $("#nickname_result").html(data);
                    join_nickname_check = 1;
                },
                error: function(xhr, status, error) {
                    $("#nickname_result").html(xhr.responseText);

                    join_nickname_check = 0;
                }
            });
        }

        function password_check() {
            password_join = $('#password').val();
            password_confirmation_join = $('#password_confirmation').val();

            if (password_join == password_confirmation_join) {
                // 비밀번호와 비밀번호확인이 일치하는지 확인

                if (password_join.length >= 6) {
                    join_password_check = 1;
                    $("#password_result").html('생성가능한 비밀번호입니다.');
                    $("#password_confirmation_result").html('생성가능한 비밀번호입니다.');
                } else {
                    join_password_check = 0;
                    $("#password_result").html('※비밀번호의 길이는 6글자이상이어야 합니다.※');
                    $("#password_confirmation_result").html('※비밀번호의 길이는 6글자이상이어야 합니다.※');
                }
            } else {
                join_password_check = 0;
                $("#password_result").html('※비밀번호와 비밀번호확인이 일치하지 않습니다.※');
                $("#password_confirmation_result").html('※비밀번호와 비밀번호확인이 일치하지 않습니다.※');
            }
        }



        $("#user_id").blur(function() {
            user_id_check();
        });

        $("#nickname").blur(function() {
            nickname_check();
        });

        $("#password").blur(function() {
            password_check();
        });

        $("#password_confirmation").blur(function() {
            password_check();
        });

        $("#password").on("keyup", function() {
            password_check();
        });

        $("#password_confirmation").on("keyup", function() {
            password_check();
        });


        $("#join_button").click(function() {
            if (join_user_id_check != 1) {
                $("#user_id").focus();
                alert('아이디를 확인하여주세요.');
            } else if (join_nickname_check != 1) {
                $("#nickname").focus();
                alert('닉네임을 확인하여주세요.');
            } else if (join_password_check != 1) {
                $("#password").focus();
                alert('패스워드를 확인하여주세요.');
            } else {
                url = "{{ route('register_post') }}";

                user_id_join = $('#user_id').val();
                nickname_join = $('#nickname').val();
                password_join = $('#password').val();
                password_confirmation_join = $('#password_confirmation').val();             
         

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        user_id: user_id_join,
                        nickname: nickname_join,
                        password: password_join,
                        password_confirmation: password_confirmation_join,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        alert('회원가입 되었습니다. 로그인하여주세요.');
                        $("#login_button").click();
                    },
                    error: function(xhr, status, error) {
                        alert('회원가입 요청을 처리하는데 문제가 있습니다. 새로고침 후 이용하시기 바랍니다.');
                    }
                });

            }
        });
    </script>
</body>

</html>
