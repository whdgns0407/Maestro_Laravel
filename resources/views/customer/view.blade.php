<html>

<head>
    @include('layouts.header')
    <title>{{ config('app.name') }} - 고객센터</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center">
        @if (auth()->user()->admin == 1)
            <form action="{{ route('admin_customer_write', ['uuid' => $uuid]) }}" method="POST">
            @else
                <form>
        @endif

        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td style="width:30%; text-align: center;">
                        제목
                    </td>
                    <td style="width:70%;">
                        {{ $view_get->title }}
                    </td>
                </tr>

                @if (auth()->user()->admin == 1)
                    <tr>
                        <td style="width:30%; text-align: center;">
                            작성자
                        </td>
                        <td style="width:70%;">
                            {{ $view_get->user_id }}
                        </td>
                    </tr>
                @endif



                <tr>
                    <td style="width:30%; text-align: center;">
                        작성일자
                    </td>
                    <td style="width:70%;">
                        {{ $view_get->created_at }}
                    </td>
                </tr>

                <tr style="">
                    <td style="vertical-align: middle; text-align: center;">
                        문의내용
                    </td>

                    <td colspan='1' style="">
                        {!! nl2br(e($view_get->content)) !!}
                    </td>
                </tr>
                @if (auth()->user()->admin != 1)
                    <tr>
                        <td style="vertical-align: middle; text-align: center;">
                            답변내용
                        </td>
                        <td colspan='1' style="">
                            @if (empty($customer_replies->content))
                                <font color="red">답변대기중...</font>
                            @else
                                {!! nl2br(e($customer_replies->content)) !!}
                                <br>
                                <br>
                                답변일시 : {{ $customer_replies->updated_at }}
                            @endif
                        </td>
                    </tr>
                @else
                    @if (!empty($customer_replies->content))
                        @php
                            $answer_content = $customer_replies->content;
                        @endphp
                    @else
                        @php
                            $answer_content = '';
                        @endphp
                    @endif
                    <tr>
                        <td colspan="2">
                            <textarea class="form-control" id="answer_content" name="answer_content" rows="1" placeholder="답변을 작성하여주세요."
                                style="height:100px;">{{ $answer_content }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" class="btn btn-primary" style="width:100%;" value="답변하기">
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
        @csrf
        </form>
        <button class="btn btn-primary" onclick="window.close();" style="width:100%;">닫기</button>
    </div>
</body>

</html>
