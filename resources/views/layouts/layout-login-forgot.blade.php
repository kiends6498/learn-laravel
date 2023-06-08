<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href=" {{ asset('css/bootstrap.min.css')}} ">
    <link rel="stylesheet" href=" {{ asset('css/style.css')}} ">
    <title>Document</title>
</head>
<body>
    <div class="background">
        <div class="background-color d-flex">
        <div class="left-div center">
            <img src="{{ asset('images/logo-left.png')}}" alt="">
        </div>
        <div class="right-div">
            <div class="right1">
                <a href="{{route('homenonlogin')}}" class="center"><img src="{{ asset('images/icon-back.png')}}" alt=""></a>
                <div class="font center pink">@yield('next-to-back')</div>
            </div>
            <div class="right2 center">
                <img src="{{ asset('images/logo-right.png')}}" alt="">
            </div>
            <div class="center">
                <div class="right3 font center">
                    @yield('text-above-form')
                </div>
            </div>
            <div>
                @yield('form')
            </div>
            <div class="right4 font center">
                @yield('text-below-form')
            </div>
        </div>
    </div>
    </div>
    <script src="{{ asset('js/bootstrap.bundle.min.css')}}"></script>
    @yield('script')
</body>
</html>