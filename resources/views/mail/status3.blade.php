<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{$status3['Message']}}</h1>
    <h3>
        @if(isset($status3['link']))
        <p><a href="{{ $status3['link'] }}">Proceed to Next Step</a></p>
    @endif
    </h3>
</body>
</html>
