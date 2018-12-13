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
    <form method="POST" action="{{ route('import') }}" enctype="multipart/form-data">
        @csrf
        <input type="file" name="excel">
        <input type="submit">
    </form>
</body>
</html>
