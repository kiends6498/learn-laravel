<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>{{ trans('messages.non-login') }}</h1>
    <a href="{{route('loginForm')}}">
        <button>
            {{ trans('messages.login-upper') }}
        </button>
    </a>
</body>
</html>