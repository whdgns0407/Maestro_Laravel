<html>

<head>
    @include('layouts.header')
    <title>{{ config('app.name') }} - {{ $board_category_sql->korean_name }}</title>
</head>

<body>
    @include('layouts.top-menu')
    <div class="container mt-5">
        <div class="container" style="width:99%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="border p-3">
                        <table border="1"
                            class="table table-striped table-hover table-bordered border-dark vertical-center"
                            style="width:100%;">
                            <tr>
                                @if (auth()->check())
                                    @if ($board_category_sql->admin_write == 1 && auth()->user()->admin != 1)
                                        @php
                                            $write_colspan = 3;
                                            $write_hidden = 'display:none;';
                                        @endphp
                                    @else
                                        @php
                                            $write_colspan = 2;
                                            $write_hidden = '';
                                        @endphp
                                    @endif
                                @else
                                    @php
                                        $write_colspan = 3;
                                        $write_hidden = 'display:none;';
                                    @endphp
                                @endif

                                <th colspan="{{ $write_colspan }}" style="text-align: center; vertical-align: middle;">
                                    <font size="6">{{ $board_category_sql->korean_name }}</font>
                                </th>
                                <th colspan="1"
                                    style="text-align: center; vertical-align: middle; {{ $write_hidden }}"
                                    onclick="window.open('{{ route('board_write_get', ['board_name' => $board_name]) }}', '_blank', 'width=900, height=900');">
                                    <button type="button" class="btn btn-secondary"
                                        style="width:100%; height:100%;">글쓰기</button>
                                </th>

                            </tr>
                            <tr>
                                <th style="width:77%;">제목</th>
                                <th style="width:13%; text-align:center;">닉네임</th>
                                <th style="width:10%; text-align:center;">작성시간</th>
                            </tr>


                            @foreach ($board_list_sqls as $board_list_sql)
                                <tr
                                    onclick="window.open('{{ route('board_view', ['board_id' => $board_list_sql->id]) }}', '_blank', 'width=900, height=900');">
                                    <td>
                                        @if (!empty($board_list_sql->title_categories_name))
                                            [{{ $board_list_sql->title_categories_name }}] -
                                        @endif
                                        {{ $board_list_sql->title }}
                                    </td>
                                    <td style="text-align:center; vertical-align: center;">
                                        {{ $board_list_sql->nickname }}</td>
                                    <td style="text-align:center; vertical-align: center;">
                                        @if ($board_list_sql->created_at->isToday())
                                            {{ $board_list_sql->created_at->format('H:i') }}
                                        @else
                                            {{ $board_list_sql->created_at->format('m-d') }}
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="{{ $write_colspan }}" class="text-center" style="vertical-align: middle;">

                                    @if (!$board_list_sqls->onFirstPage())
                                        <a href="{{ $board_list_sqls->previousPageUrl() }}" class="btn btn-secondary">
                                            이전
                                        </a>
                                    @endif


                                    @php
                                        $currentPage = $board_list_sqls->currentPage();
                                        $lastPage = $board_list_sqls->lastPage();
                                        $visiblePages = 5; // 각 페이지에서 보이는 페이지 수
                                    @endphp





                                    @foreach ($board_list_sqls->getUrlRange(max(1, $currentPage - 2), min($lastPage, $currentPage + 2)) as $page => $url)
                                        @if ($page == $board_list_sqls->currentPage())
                                            <button class="btn btn-secondary disabled">{{ $page }}</button>
                                        @else
                                            <a href="{{ $url }}"
                                                class="btn btn-secondary">{{ $page }}</a>
                                        @endif
                                    @endforeach





                                    @if ($board_list_sqls->hasMorePages())
                                        <a href="{{ $board_list_sqls->nextPageUrl() }}" class="btn btn-secondary">
                                            다음
                                        </a>
                                    @endif






                                </td>

                                <td colspan="1"
                                    style="text-align:center; vertical-align: middle; {{ $write_hidden }}"
                                    onclick="window.open('{{ route('board_write_get', ['board_name' => $board_name]) }}', '_blank', 'width=900, height=900');">
                                    <button type="button" class="btn btn-secondary"
                                        style="width:100%; height:100%;">글쓰기</button>

                                </td>
                            </tr>

                            <tr style="display:none;">
                                <td colspan="3" class="text-center">
                                    <form class="form-inline justify-content-center"> <!-- 중앙 정렬 -->
                                        <select class="form-control" id="searchBy" style="width:20%;">
                                            <option value="title">제목+내용</option>
                                            <option value="author">글쓴이</option>
                                        </select>
                                        <input type="text" class="form-control" id="searchTerm"
                                            placeholder="검색어를 입력하세요">

                                        &nbsp; <button type="button" class="btn btn-secondary"
                                            id="searchButton">검색</button>
                                    </form>
                                </td>
                            </tr>


                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Agent 라이브러리를 사용하여 모바일 디바이스 여부 확인
            function isMobile() {
                return window.innerWidth <= 768; // 화면 너비가 768px 이하일 때 모바일로 간주
            }

            function adjustFontSize() {
                if (isMobile()) {
                    // 모바일 환경일 때 폰트 크기를 조절
                    $('td, th, button').css('font-size', '9px'); // 원하는 폰트 크기로 변경
                } else {
                    // 모바일 환경이 아닐 때 기본 폰트 크기로 복원
                    $('td, th, button').css('font-size', ''); // 비워서 기본값으로 되돌림
                }
            }

            // 최초 준비 완료 시 폰트 크기 조절
            adjustFontSize();

            // 창 크기 변경 시 폰트 크기 조절
            $(window).resize(adjustFontSize);

        });
    </script>


</body>

</html>
