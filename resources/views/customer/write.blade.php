<html>

<head>
    @include('layouts.header')
    <title>{{ config('app.name') }} - 고객센터</title>
</head>

<body>
    @include('layouts.top-menu')

    <div class="container mt-5">
        <h1>고객센터 1:1 문의</h1>
        <form action="{{ route('customer_write_post') }}" method="POST" id="customer_form">
            <div class="form-group">
                <label for="category">문의 유형</label>
                <select class="form-control" id="category" name="category" onchange="category_change();">
                    @foreach ($customer_categories as $category)
                        <option value='{{ $category->id }}'>{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="content">문의 내용</label>
                <textarea class="form-control" id="content" name="content" rows="4" placeholder="문의하실 내용을 입력해주세요"></textarea>
            </div>
            @csrf
            <button type="submit" class="btn btn-primary" style="width:100%; height:60px; font-size:23px;"
                id="submit_button" name="submit_button" onclick="submit_disable();">문의하기</button>
        </form>

        <div class="mt-5">
            <h2>나의 문의 내역</h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>제목</th>
                        <th>상태</th>
                        <th>등록일</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($lists) <= 0)
                        <tr>
                            <td colspan="3" style="text-align:center;">작성된 문의사항이 없습니다. &nbsp; &nbsp; &nbsp;</td>
                        </tr>
                    @else
                        @foreach ($lists as $list)
                            <tr
                                onclick="window.open('{{ route('customer_view', ['uuid' => $list->uuid]) }}', '_blank', 'width=600, height=800');">

                                <td><a href="#">{{ $list->title }}</a></td>
                                <td>
                                    @if (empty($list->status))
                                        <font color="red">답변대기중</font>
                                    @else
                                        <font coloe="blue">답변완료</font>
                                    @endif
                                </td>
                                <td>{{ $list->created_at }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $("#content").val("입금은행: \n입금자명: \n입금금액: ");
        });


        function submit_disable() {
            $("#customer_form").submit();
            $("#submit_button").attr("disabled", true);
        }

        function category_change() {
            category = $("#category").val();
            console.log(category);
            $("#content").val("");
            @foreach ($customer_categories as $category)
                if (category === "{{ $category->id }}") {
                    $("#content").val("{{ $category->content }}");
                }
            @endforeach
        }
    </script>
</body>

</html>
