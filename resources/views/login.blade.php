@extends('layouts.layout-login-forgot')

@section('next-to-back')
{{ trans('messages.login-upper') }}
@endsection

@section('text-above-form')
{{ trans('messages.welcome') }}
@endsection

@section('form')
<form action="{{route('login')}}" class="form-custom" method="POST">
    @csrf
    <div class="d-grid center">
    <div class="mb-3 form-control rectangle center-height font input" >
        <div><img src="{{ asset('images/mail.png')}}" alt=""></div>
        <input type="email" name="email" placeholder="{{ trans('messages.input-email-phone') }}">
    </div>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
 
    <div class="mb-3 form-control rectangle center-height font input">
        <div><img src="{{ asset('images/pass.png')}}" alt=""></div>
        <input id="passwordInput" name="password" type="password" placeholder="{{ trans('messages.input-password') }}">
        <div>
            <img id="eyeIcon" src="{{ asset('images/eye-hidden.png')}}" alt="">
        </div>
    </div>
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    
        <button type="submit" name="login" class="rectangle font white" id="button">
            {{ trans('messages.login-lower') }}
        </button>
    </div>
    
</form>
@endsection

@section('text-below-form')
    <a href="{{route('sendOTPForm')}}" style="text-decoration: none; color: #000000">{{ trans('messages.forgot-password-lower') }}</a>
    <a href="{{route('registerForm')}}" style="text-decoration: none; color: #000000">{{ trans('messages.register-lower') }}</a>
@endsection

@section('script')
<script>
    const passwordInput = document.getElementById("passwordInput");
    const eyeIcon = document.getElementById("eyeIcon");

    eyeIcon.addEventListener("click", function() {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.src = "{{ asset('images/eye.png')}}";
        } else {
            passwordInput.type = "password";
            eyeIcon.src = "{{ asset('images/eye-hidden.png')}}";
        }
    });
</script>
@endsection

@if ($errors->has('message'))
    <script>
        alert('{{ $errors->first('message') }}');
    </script>
@endif

{{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}