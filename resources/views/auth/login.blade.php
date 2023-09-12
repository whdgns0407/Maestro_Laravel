<html>

<head>
    <title>{{ config('app.name') }} - 로그인</title>
    <link rel="shortcut icon" type="image/x-icon" href="./icon.ico">
    <meta name="viewport" content="width=device-width", initial-scale="1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
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
                                    <h3>로그인</h3>
                                </label>
                                <h4>아이디</h4>
                                <input type="text" class="form-control" id="id" name="id"
                                    placeholder="아이디를 입력하여주세요." value="" maxlength="30" required autofocus>

                                <h4>비밀번호</h4>
                                <input type="password" class="form-control" maxlength="30" id="password"
                                    name="password" placeholder="비밀번호를 입력하여주세요." required autofocus>
                                @csrf
                                <br>
                                <input class="btn btn-lg btn-secondary btn-block" type="submit" value="로그인하기 »">
                            </fieldset>
                        </form>
                    </div>
                    <a href="{{ route('register_get') }}"><input class="btn btn-lg btn-secondary btn-block"
                            type="button" value="회원가입"></a>
                    <a href="{{ route('welcome') }}"><input class="btn btn-lg btn-secondary btn-block" type="button"
                            value="메인화면"></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
