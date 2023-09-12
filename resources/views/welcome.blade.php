<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.header')
    <title>{{ config('app.name') }}</title>
</head>

<!-- <body style="background-color: white; width:100%;">-->

<body>
    <style type="text/css">
        .jumbotron {
            background: url(/background.jpg);
            no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            color: white;
        }

        .table-cell {
            max-width: 240px;
            /* 셀의 최대 너비 설정 */
            white-space: nowrap;
            /* 텍스트 줄바꿈 방지 */
            overflow: hidden;
            /* 넘치는 텍스트 감추기 */
            text-overflow: ellipsis;
            /* 넘친 텍스트에 '...' 추가하여 표시 */
        }
    </style>
    @include('layouts.top-menu')
    <div class="jumbotron" style="width:100%;">
        <h1 class="text-center" style="font-size:55px;">{{ config('app.name') }}</h1>
        <!--
        <p class="text-center">
            <iframe width="50%" height="400" src="https://www.youtube.com/embed/ebCPZgaEj0w"
                title="YouTube video player" frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                allowfullscreen>
            </iframe>
        </p>
    -->
    </div>
    <div class="container" style="width:100%;">
        <div class="row">
            <div class="col-md-6">
                <div class="border p-3">
                    <table border="1" class="table table-striped table-hover table-bordered border-dark">
                        <tr>
                            <th style="text-align:center;" colspan="2">
                                <a href="{{ route('board_list_get', ['board_name' => 'coininfo']) }}">
                                    <h3>코인정보</h3>
                                </a>
                            </th>
                        </tr>
                        @foreach ($coininfo_board_sqls as $coininfo_board_sql)
                            <tr onclick="board_view('coininfo', '{{ $coininfo_board_sql->id }}');">
                                <td colspan="1" class="table-cell" style="width:80%;">
                                    @if (!empty($coininfo_board_sql->title_categories_name))
                                        [{{ $coininfo_board_sql->title_categories_name }}] -
                                    @endif
                                    {{ $coininfo_board_sql->title }}
                                </td>

                                <td colspan="1" class="table-cell" style="width:20%; text-align:center;">
                                    @if ($coininfo_board_sql->created_at->isToday())
                                        {{ $coininfo_board_sql->created_at->format('H:i') }}
                                    @else
                                        {{ $coininfo_board_sql->created_at->format('m-d') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <br>
            <div class="col-md-6">
                <div class="border p-3">
                    <table border="1" class="table table-striped table-hover table-bordered border-dark">
                        <tr>
                            <th style="text-align:center;" colspan="2">
                                <a href="{{ route('board_list_get', ['board_name' => 'free']) }}">
                                    <h3>자유게시판</h3>
                                </a>
                            </th>
                        </tr>
                        @foreach ($free_board_sqls as $free_board_sql)
                            <tr onclick="board_view('free', '{{ $free_board_sql->id }}')">
                                <td colspan="1" class="table-cell" style="width:80%;">
                                    @if (!empty($free_board_sql->title_categories_name))
                                        [{{ $free_board_sql->title_categories_name }}] -
                                    @endif
                                    {{ $free_board_sql->title }}
                                </td>

                                <td colspan="1" class="table-cell" style="width:20%; text-align:center;">
                                    @if ($free_board_sql->created_at->isToday())
                                        {{ $free_board_sql->created_at->format('H:i') }}
                                    @else
                                        {{ $free_board_sql->created_at->format('m-d') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="container" style="width:100%;">
        <div class="row">
            <div class="col-md-6">
                <div class="border p-3">
                    <table border="1" class="table table-striped table-hover table-bordered border-dark">
                        <tr>
                            <th style="text-align:center;" colspan="2">
                                <a href='{{ route('board_list_get', ['board_name' => 'mining']) }}'>
                                    <h3>채굴게시판</h3>
                                </a>
                            </th>
                        </tr>
                        @foreach ($mining_board_sqls as $mining_board_sql)
                            <tr onclick="board_view('mining', '{{ $mining_board_sql->id }}')">
                                <td colspan="1" class="table-cell" style="width:80%;">
                                    @if (!empty($mining_board_sql->title_categories_name))
                                        [{{ $mining_board_sql->title_categories_name }}] -
                                    @endif
                                    {{ $mining_board_sql->title }}
                                </td>

                                <td colspan="1" class="table-cell" style="width:20%; text-align:center;">
                                    @if ($mining_board_sql->created_at->isToday())
                                        {{ $mining_board_sql->created_at->format('H:i') }}
                                    @else
                                        {{ $mining_board_sql->created_at->format('m-d') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border p-3">
                    <table border="1" class="table table-striped table-hover table-bordered border-dark">
                        <tr>
                            <th style="text-align:center; vertical-align: middle;" colspan="2">
                                <a href='{{ route('board_list_get', ['board_name' => 'pnl']) }}'>
                                    <h3>손익인증게시판</h3>
                                </a>
                            </th>
                        </tr>
                        @foreach ($pnl_sqls as $pnl_sql)
                            <tr onclick="board_view('pnl', '{{ $pnl_sql->id }}')">
                                <td colspan="1" class="table-cell" style="width:80%;">
                                    @if (!empty($pnl_sql->title_categories_name))
                                        [{{ $pnl_sql->title_categories_name }}] -
                                    @endif
                                    {{ $pnl_sql->title }}
                                </td>

                                <td colspan="1" class="table-cell" style="width:20%; text-align:center;">
                                    @if ($pnl_sql->created_at->isToday())
                                        {{ $pnl_sql->created_at->format('H:i') }}
                                    @else
                                        {{ $pnl_sql->created_at->format('m-d') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="width:100%;">
        <div class="row">
            <div class="col-md-6">
                <div class="border p-3">
                    <table border="1" class="table table-striped table-hover table-bordered border-dark">
                        <tr>
                            <th style="text-align:center;" colspan="2">
                                <a href='{{ route('board_list_get', ['board_name' => 'registerationgreeting']) }}'>
                                    <h3>가입인사</h3>
                                </a>
                            </th>
                        </tr>
                        @foreach ($registerationgreeting_sqls as $registerationgreeting_sql)
                            <tr onclick="board_view('registerationgreeting', '{{ $registerationgreeting_sql->id }}')">
                                <td colspan="1" class="table-cell" style="width:80%;">
                                    @if (!empty($registerationgreeting_sql->title_categories_name))
                                        [{{ $registerationgreeting_sql->title_categories_name }}] -
                                    @endif
                                    {{ $registerationgreeting_sql->title }}
                                </td>

                                <td colspan="1" class="table-cell" style="width:20%; text-align:center;">
                                    @if ($registerationgreeting_sql->created_at->isToday())
                                        {{ $registerationgreeting_sql->created_at->format('H:i') }}
                                    @else
                                        {{ $registerationgreeting_sql->created_at->format('m-d') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="border p-3">
                    <table border="1" class="table table-striped table-hover table-bordered border-dark">
                        <tr>
                            <th style="text-align:center; vertical-align: middle;" colspan="2">
                                <a href='{{ route('board_list_get', ['board_name' => 'notice']) }}'>
                                    <h3>공지사항</h3>
                                </a>
                            </th>
                        </tr>
                        @foreach ($notice_sqls as $notice_sql)
                            <tr onclick="board_view('notice', '{{ $notice_sql->id }}')">
                                <td colspan="1" class="table-cell" style="width:80%;">
                                    @if (!empty($notice_sql->title_categories_name))
                                        [{{ $notice_sql->title_categories_name }}] -
                                    @endif
                                    {{ $notice_sql->title }}
                                </td>

                                <td colspan="1" class="table-cell" style="width:20%; text-align:center;">
                                    @if ($notice_sql->created_at->isToday())
                                        {{ $notice_sql->created_at->format('H:i') }}
                                    @else
                                        {{ $notice_sql->created_at->format('m-d') }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        function board_view(board_name, view_id) {
            window.open("/board/view/" + view_id, '_blank', 'width=900, height=900');

            window.location.href = "/board/list/" + board_name;
        }
    </script>
</body>

</html>
