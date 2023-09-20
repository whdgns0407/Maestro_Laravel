<html>

<head>
    @include('layouts.header')
    <title>{{ config('app.name') }}</title>
</head>

<body>
    @include('layouts.top-menu')
    <div class="container mt-5">
        <div class="container" style="width:99%;">
            <div class="row">
                <div class="col-md-12">
                    <div class="border p-3">
                        <table class="table  table-bordered border-dark vertical-center" style="width:100%;">
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    수량
                                </td>
                                <td colspan="1" style="width:20%; text-align: center; vertical-align: middle;">
                                    가격
                                </td>
                                <td colspan="2" rowspan="4" style="width:40%;">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>

                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    주문 가능 KRW
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    1,000,000
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    주문 가능 {{ $coin }}
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    1,000,000
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle; background-color : white"
                                    id="buy_td" onclick="trade_type_button('buy');">
                                    <button style="width:100%; background-color: FBEFEF;" id="buy_button">
                                        매수
                                    </button>
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle; background-color : white"
                                    id="sell_td" onclick="trade_type_button('sell');">
                                    <button style="width:100%; background-color: #EFFBFB" id="sell_button">
                                        매도
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    <font id="type_message">매수</font>가격
                                </td>
                                <td>
                                    <input style="width:100%;" type="text" id="price">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    주문수량
                                </td>
                                <td>
                                    <input style="width:100%;" type="text" id="amount">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    주문총액
                                </td>
                                <td style="width:20%; text-align: center; vertical-align: middle;">
                                    15,000,000
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="width:40%; text-align: center; vertical-align: middle;">
                                    1.004
                                </td>
                                <td colspan="1"
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #EFFBFB">
                                    10,000,000
                                </td>
                                <td colspan="2">
                                    <button style="width:100%; height:100%; background-color: #FBEFEF" id="type_button">
                                        매수하기
                                    </button>
                                </td>
                            </tr>



                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    시간
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    가격
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    수량
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>

                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
                                </td>
                            </tr>
                            <tr>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    00:00
                                </td>
                                <td style="width:13%; text-align: center; vertical-align: middle;">
                                    100,000,000
                                </td>
                                <td style="width:14%; text-align: center; vertical-align: middle;">
                                    123456789.0000
                                </td>
                                <td
                                    style="width:20%; text-align: center; vertical-align: middle; background-color : #FBEFEF">
                                    10,000,000
                                </td>
                                <td style="width:40%; text-align: center; vertical-align: middle;" colspan="2">
                                    10,000,000
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




        type = "buy";
        korean_type = "매수";
        $("#buy_button").css('color', 'red');
        $('#buy_button').css('font-weight', 'bold');


        // 매수, 매도 type버튼 시 스타일 변경
        function trade_type_button(type_button) {
            type = type_button;
            $('#buy_button').css('backgrount-color', 'white');
            $('#sell_button').css('backgrount-color', 'white');

            $('#buy_button').css('font-weight', 'normal');
            $('#sell_button').css('font-weight', 'normal');

            $('#buy_button').css('color', 'black');
            $('#sell_button').css('color', 'black');


            if (type == "buy") {
                korean_type = "매수";
                color = "#FBEFEF";
                color_bold = "red";
            } else if (type == "sell") {
                korean_type = "매도";
                color = '#EFFBFB';
                color_bold = "blue";
            } else {
                korean_type = "error";
                color = 'black';
                color_bold = "black";
            }
            $('#type_message').text(korean_type);
            $('#type_button').css('background-color', color);
            $('#type_button').text(korean_type + "하기");
            $("#" + type + "_button").css('font-weight', 'bold');
            $("#" + type + "_button").css('color', color_bold);
        }




        // 매수하기, 매도하기 버튼 클릭 시 ajax실행
        $("#type_button").click(function() {
            coin = "{{ $coin }}";
            price = $('#price').val();
            amount = $('#amount').val();

            var confirmation = confirm("정말로 " + coin + "코인을 " + price.toLocaleString() + "원에 " + amount
                .toLocaleString() + "개 " + korean_type +
                " 하시겠습니까?");

            if (confirmation) {
                $.ajax({
                    url: "{{ route('trade_input') }}",
                    type: "POST",
                    data: {
                        type: type,
                        coin: coin,
                        price: price,
                        amount: amount,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        alert(data)
                    },
                    error: function(xhr, status, error) {
                        alert(xhr.responseText);
                    }
                });
            }
        });





        setInterval(price_ajax, 1000);

        function price_ajax() {
            $.ajax({
                url: "{{ route('trade_hoga_ajax', ['coin' => $coin]) }}", // 요청 보낼 URL
                method: "GET", // GET 요청
                dataType: "json", // 응답 데이터 타입 (JSON)
                success: function(data) {
                    console.log(data);
                }, // success 함수 끝
                error: function() {
                    // 실패 시 에러 메시지 출력
                }
            });
        }
    </script>


</body>

</html>
