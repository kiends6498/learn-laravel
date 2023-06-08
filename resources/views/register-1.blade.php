@extends('layouts.layout-login-forgot')

@section('next-to-back')
{{ trans('messages.register-upper') }}
@endsection

@section('text-above-form')
{{ trans('messages.note-register-1') }}
@endsection

@section('form')
<form action="{{route('register')}}" class="form-custom" method="POST">
    @csrf

    <div class="d-grid center">
        <div class="mb-3 form-control rectangle center-height font input" >
            <div><img src="{{ asset('images/person.png')}}" alt=""></div>
            <input type="text" name="name" placeholder="{{ trans('messages.fullname') }}">
        </div>

        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="mb-3 form-control rectangle center-height font input" >
            <div><img src="{{ asset('images/mail.png')}}" alt=""></div>
            <input type="email" name="email" placeholder="Email">
        </div>
        
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror


        <div class="mb-3 form-control rectangle center-height font input" >
            <div><img src="{{ asset('images/pass.png')}}" alt=""></div>
            <input id="passwordInput" name="newPassword" type="password" placeholder="{{ trans('messages.new-password') }}">
            <div>
                <img id="eyeIcon" src="{{ asset('images/eye-hidden.png')}}" alt="">
            </div>
        </div>

        @error('newPassword')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
 
        <div class="mb-3 form-control rectangle center-height font input">
            <div><img src="{{ asset('images/pass.png')}}" alt=""></div>
            <input id="passwordInput1" name="cfPassword" type="password" placeholder="{{ trans('messages.confirm-new-password') }}">
            <div>
                <img id="eyeIcon1" src="{{ asset('images/eye-hidden.png')}}" alt="">
            </div>
        </div>

        @error('cfPassword')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        {{-- chỗ submit hình như không để name vẫn chạy được --}}
        <button type="submit" name="reset-password" class="rectangle font white" id="button">
            {{ trans('messages.register-lower') }}
        </button>
    </div>
    
</form>
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

    const passwordInput1 = document.getElementById("passwordInput1");
    const eyeIcon1 = document.getElementById("eyeIcon1");

    eyeIcon1.addEventListener("click", function() {
        if (passwordInput1.type === "password") {
            passwordInput1.type = "text";
            eyeIcon1.src = "{{ asset('images/eye.png')}}";
        } else {
            passwordInput1.type = "password";
            eyeIcon1.src = "{{ asset('images/eye-hidden.png')}}";
        }
    });
</script>
@endsection

@if ($errors->has('message'))
    <script>
        alert('{{ $errors->first('message') }}');
    </script>
@endif