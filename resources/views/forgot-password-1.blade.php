@extends('layouts.layout-login-forgot')

@section('next-to-back')
{{ trans('messages.forgot-password-upper') }}
@endsection

@section('text-above-form')
{{ trans('messages.note-forgot-password-1') }}
@endsection

@section('form')
<form action="{{route('sendOtpViaEmail')}}" class="form-custom" method="POST">
    @csrf
    <div class="d-grid center">
    <div class="mb-3 form-control rectangle center-height font input" >
        <div><img src="{{ asset('images/mail.png')}}" alt=""></div>
        <input type="email" name="email" placeholder="Email">
    </div>
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    
        <button type="submit" name="login" class="rectangle font white" id="button">
            {{ trans('messages.continue') }}
        </button>
    </div>
</form>
@endsection

@if ($errors->has('message'))
    <script>
        alert('{{ $errors->first('message') }}');
    </script>
@endif