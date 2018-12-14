<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Excel</title>
    <style>
    body {
        background-color: powderblue;
    }
    .center {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 400px;
        height: 400px;
        transform: translate(-50%, -50%);
    }
    #message {
        color: red;
    }
    </style>
</head>
<body>
    <div class="center">
        <form method="POST" action="{{ route('items.import') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="token" value="{{ now()->timestamp }}">
            <input type="file" name="excel" required>
            <input type="submit">
        </form>
        <hr>
        說明：<br>
        　　1. 檔案可為 <a href="{{ asset('/files/example.xlsx') }}">.xlsx</a> 或 <a href="{{ asset('/files/example.csv') }}">.csv</a> 檔。<br>
        　　2. 檔案名稱須為英數字。<br>
        　　3. 資料不宜大於 80,000 列。<br>
        　　4. 資料第三行須為數字。<br>
        　　5. 可開啟多個視窗進行操作。
        <hr>
        <div id="message">
            @if(Session::has('message'))
                {{ Session::get('message') }}
            @endif
        </div>
    </div>
</body>
<script>
function fadeOut(el){
    message.style.opacity = 1;

    (function fade() {
        if ((message.style.opacity -= .1) < 0) {
            message.style.display = 'none';
        } else {
            requestAnimationFrame(fade);
        }
    })();
}

let message = document.querySelector('#message');

setTimeout(function(){
    fadeOut(message);
}, 5000);
</script>
</html>
