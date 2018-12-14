<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Excel</title>
</head>
<body>
    <form method="POST" action="{{ route('items.import') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel">
        <input type="submit">
    </form>
    
    <p id="message">
        @if(Session::has('message'))
            {{ Session::get('message') }}
        @endif
    </p>

    <script>
        function fadeOut(el){
            message.style.opacity = 1;

            (function fade() {
                if ((message.style.opacity -= .1) < 0) {
                    message.style.display = "none";
                } else {
                    requestAnimationFrame(fade);
                }
            })();
        }
        
        let message = document.querySelector('#message');

        setTimeout(function(){
            fadeOut(message);
        }, 3000);
    </script>
</body>
</html>
