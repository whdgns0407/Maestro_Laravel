<html>

<head>
    @include('layouts.header')
    <title>{{ config('app.name') }} - 이메일인증</title>
</head>

<body>
    @include('layouts.top-menu')
    <div class="container mt-5">
        <h3>네이버 메일인증을 받아야만 고객센터이용이 가능합니다.</h3>
        <table class="table">
            <tr>
                <td>
                    @if (Auth::user()->email)
                        <input type="text" id="email" value="{{ Auth::user()->email }}" readonly>
                    @else
                        <input type="text" id="email">@naver.com <br>(인증번호 전송 시 더이상 이메일주소 수정은 불가능합니다.)
                    @endif
                    | <button id="sendmail_button">이메일 전송하기</button>
                </td>
            </tr>

            <tr style="display:none;" id="tr_code">
                <td><input type="text" id="code"> | <button id="sendmail_code_ok">인증코드확인</button></td>
            </tr>
        </table>
    </div>
    <script>
        $('#sendmail_button').on('click', function() {
            email = $("#email").val();
            $("#sendmail_button").hide();

            $.ajax({
                type: "POST",
                url: "{{ route('customer_send_email_code') }}",
                data: {
                    email: email,
                    _token: '{{ csrf_token() }}'
                },
                success: function(success) {
                    alert(success);
                    $('#email').prop('disabled', true);
                    $('#tr_code').show();
                    $("#sendmail_button").show();
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                    $("#sendmail_button").show();
                }
            });

        });



        $('#sendmail_code_ok').on('click', function() {
            code = $("#code").val();
            $.ajax({
                type: "POST",
                url: "{{ route('customer_send_email_check_code') }}",
                data: {
                    code: code,
                    _token: '{{ csrf_token() }}'
                },
                success: function(success) {
                    alert(success);
                    window.location.href = "{{ route('customer_write_get') }}";
                },
                error: function(xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        });
    </script>

</body>

</html>
