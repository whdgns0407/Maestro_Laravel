<html>

<head>
    @include('layouts.header')
    <title>{{ config('app.name') }} - 원화->코인 스왑</title>

    <style>
        td {
            transition: background-color 0.3s ease;
            /* 배경색 전환에 대한 CSS 트랜지션 설정 */
        }
    </style>
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
                                <th style="width:100%; text-align:center; vertical-align: middle;" colspan="4">
                                    @if ($swap_to == 'krw')
                                        코인->원화 스왑
                                    @elseif($swap_to == 'coin')
                                        원화->코인 스왑
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                <th style="width:15%; text-align:center; vertical-align: middle;">코인</th>
                                <th style="width:31%; text-align:center; vertical-align: middle;">스왑가격</th>
                                <th style="width:29%; text-align:center; vertical-align: middle;">개수</th>
                                <th style="width:25%; text-align:center; vertical-align: middle;">스왑</th>
                            </tr>
                            <tr>
                                <td style="text-align:center; vertical-align: middle;">BTC</td>
                                <td id="BTC_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="BTC_input_text" type="text" style="width:60%;">
                                    <button id="BTC_max"
                                        onclick="max_button('{{ $type }}', 'BTC');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:center; vertical-align: middle;">ETH</td>
                                <td id="ETH_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="ETH_input_text" type="text" style="width:60%;">
                                    <button id="ETH_max"
                                        onclick="max_button('{{ $type }}', 'ETH');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:center; vertical-align: middle;">BCH</td>
                                <td id="BCH_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="BCH_input_text" type="text" style="width:60%;">
                                    <button id="BCH_max"
                                        onclick="max_button('{{ $type }}', 'BCH');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:center; vertical-align: middle;">ETC</td>
                                <td id="ETC_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="ETC_input_text" type="text" style="width:60%;">
                                    <button id="ETC_max"
                                        onclick="max_button('{{ $type }}', 'ETC');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:center; vertical-align: middle;">EOS</td>
                                <td id="EOS_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="EOS_input_text" type="text" style="width:60%;">
                                    <button id="EOS_max"
                                        onclick="max_button('{{ $type }}', 'EOS');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:center; vertical-align: middle;">XRP</td>
                                <td id="XRP_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="XRP_input_text" type="text" style="width:60%;">
                                    <button id="XRP_max"
                                        onclick="max_button('{{ $type }}', 'XRP');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:center; vertical-align: middle;">ADA</td>
                                <td id="ADA_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="ADA_input_text" type="text" style="width:60%;">
                                    <button id="ADA_max"
                                        onclick="max_button('{{ $type }}', 'ADA');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>

                            <tr>
                                <td style="text-align:center; vertical-align: middle;">DOGE</td>
                                <td id="DOGE_price" style="text-align:center; vertical-align: middle;"><img
                                        src="/img/loading.gif"></td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <input id="DOGE_input_text" type="text" style="width:60%;">
                                    <button id="DOGE_max"
                                        onclick="max_button('{{ $type }}', 'DOGE');">최대</button>
                                </td>
                                <td style="text-align:center; vertical-align: middle;">
                                    <button style="width:100%; text-align:center; vertical-align: middle;"
                                        onclick="">
                                        스왑
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var user = {
            KRW: 0,
            KRW_using: 0,
            BTC: 0,
            BTC_using: 0,
        };


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

            setInterval(price_ajax, 1000);
            url = "{{ route('swap_price_ajax') }}";

            function price_ajax() {
                $.ajax({
                    url: url, // 요청 보낼 URL
                    method: "GET", // GET 요청
                    dataType: "json", // 응답 데이터 타입 (JSON)
                    success: function(data) {
                        for (i = 0; i < data.api_data.length; i++) {
                            if ($("#" + data.api_data[i].type + "_price")) {


                                before_price_text = $("#" + data.api_data[i].type + "_price")
                                    .text(); // td 요소의 텍스트 가져오기

                                before_price = parseFloat(before_price_text.replace(/,/g, '').replace(
                                    ' 원', '')); // td 요소 변환

                                @if ($swap_to == 'krw')
                                    $("#" + data.api_data[i].type + "_price").text(data.api_data[i]
                                        .buy3_price.toLocaleString() + " 원");
                                    api_data_price = data.api_data[i].buy3_price;
                                @elseif ($swap_to == 'coin')
                                    $("#" + data.api_data[i].type + "_price").text(data.api_data[i]
                                        .sell3_price.toLocaleString() + " 원");
                                    api_data_price = data.api_data[i].sell3_price;
                                @endif

                                if (api_data_price != before_price) {
                                    $("#" + data.api_data[i].type + "_price").css("font-weight",
                                        "bold");

                                    (function(index) {
                                        setTimeout(function() {
                                            $("#" + data.api_data[index].type + "_price")
                                                .css(
                                                    "font-weight", "normal");
                                        }, 200);
                                    })(i); // 함수 클로저를 사용하여 index 값을 보존
                                }
                            } // if문 끝

                        } // for문 끝 
                        user['KRW'] = data.user_krw;
                        user['KRW_using'] = data.user_krw_using;
                        user['BTC'] = data.user_btc;
                        user['BTC_using'] = data.user_btc_using;
                    }, // success 함수 끝
                    error: function() {
                        // 실패 시 에러 메시지 출력
                    }
                });
            }
        });



        function max_button(type, coin) {
            if (type == "buy") {
                price_text = $("#" + coin + "_price").text();
                // td 요소의 텍스트 가져오기

                price = parseFloat(price_text.replace(/,/g, '').replace(' 원', ''));

                input_data = user['KRW'] / price; // input data에 넣을 것
                input_data = Math.floor(input_data * 10000) / 10000;
                $("#" + coin + "_input_text").val(input_data);
            } else if (type == "sell") {
                input_data = user[coin]; // input data에 넣을 것

                input_data = Math.floor(input_data * 10000) / 10000;
                $("#" + coin + "_input_text").val(input_data);
            } else {
                alert("에러 새로고침 후 재시도 바랍니다.");
            }
        }


        function swap_ajax(type, coin) {
         



            $.ajax({
                url: "", // 요청할 URL
                method: "GET", // HTTP 메서드
                data: {
                    type: category,
                    coin: coin,
                    content: content,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                   alert(data); // 응답 데이터 표시
                },
                error: function() {
                    $("#response").html("Error occurred.");
                }
            });


        }
    </script>


</body>

</html>
