<meta charset="UTF-8">
<meta name="viewport" content="width=device-width", initial-scale="1">
<link rel="stylesheet" href="/css/bootstrap.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="/js/bootstrap.js"></script>
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
        {{ Session::forget('error') }};
    @endif


    @if (session('message'))
        var message = '{{ session('message') }}';
        alert(message);
        {{ Session::forget('message') }};
    @endif
</script>
<style>
    .table td {
        word-wrap: break-word;
    }
</style>


