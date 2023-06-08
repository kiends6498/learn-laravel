@extends('layouts.layout-login-forgot')

@section('next-to-back')
{{ trans('messages.register-upper') }}
@endsection

@section('text-above-form')
{{ trans('messages.note-register-2') }}
@endsection

@section('form')
    <div class="center">
        <img src="{{ asset('images/success.png')}}" alt="">
    </div>
    <div class="center">
    <a style="margin-top: 50px" href="{{route('loginForm')}}">
        <button type="submit" name="login" class="rectangle font white" id="button">
            OK
        </button>
    </a>
</div>
</form>
@endsection

