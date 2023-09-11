<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('welcome') }}">{{ config('app.name') }}</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    게시판
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('board_list_get', ['board_name' => 'coininfo']) }}">코인정보</a>
                    <a class="dropdown-item" href="{{ route('board_list_get', ['board_name' => 'free']) }}">자유게시판</a>
                    <a class="dropdown-item" href="{{ route('board_list_get', ['board_name' => 'mining']) }}">채굴게시판</a>
                    <a class="dropdown-item" href="{{ route('board_list_get', ['board_name' => 'pnl']) }}">손익인증게시판</a>
                    <a class="dropdown-item" href="{{ route('board_list_get', ['board_name' => 'registerationgreeting']) }}">가입인사</a>
                </div>
            </li>

            <li class="nav-item active">
                <a class="nav-link disabled" href="{{ route('board_list_get', ['board_name' => 'notice']) }}">공지사항</a>
            </li> 

            <li class="nav-item active">
                <a class="nav-link disabled" href="{{ route('customer_write_get') }}">고객센터</a>
            </li>
            
        </ul>

        <ul class="navbar-nav navbar-right">

            <li class="nav-item active">
                <a class="nav-link disabled" href="https://open.kakao.com/o/gs0MuCAf" target="_blank">오픈채팅(비밀번호
                    6300)</a>
            </li>

            @if (auth()->user())
                <li class="nav-item active">
                    <a class="nav-link disabled">{{ auth()->user()->nickname }}님 안녕하세요</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link disabled" href="{{ route('logout') }}">로그아웃</a>
                </li>
            @else
                <li class="nav-item active">
                    <a class="nav-link disabled" href="{{ route('login_get') }}">로그인</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link disabled" href="{{ route('register_get') }}">회원가입</a>
                </li>
            @endif
        </ul>
    </div>
</nav>
