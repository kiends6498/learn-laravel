@extends('layouts.layout-login-forgot')

@section('next-to-back')
{{ trans('messages.forgot-password-upper') }}
@endsection

@section('text-above-form')
{{ trans('messages.note-forgot-password-2') }}
@endsection

@section('form')
<form action="{{route('verifyOTP')}}" class="form-custom" method="POST">
  @csrf
    <div class="d-grid center">
        <div class="otp-container">
            <input type="hidden" name="email" value="{{ $email }}">
            <input type="text" name="otp1" class="input-otp" maxlength="1">
            <input type="text" name="otp2" class="input-otp" maxlength="1">
            <input type="text" name="otp3" class="input-otp" maxlength="1">
            <input type="text" name="otp4" class="input-otp" maxlength="1">
            <input type="text" name="otp5" class="input-otp" maxlength="1">
            <input type="text" name="otp6" class="input-otp" maxlength="1">
          </div>
          @if ($errors->any())
            <div class="alert alert-danger">
              <p>{{ $errors->first() }}</p>
            </div>
          @endif
        <button type="submit" name="verify-otp" class="rectangle font white" id="button">
            Tiếp tục
        </button>
    </div>
</form>
@endsection

@section('text-below-form')
{{ trans('messages.not-receive-OTP') }} 
<a href="{{ route('resend-otp', ['email' => request('email')]) }}" style="text-decoration: none; color: #C32270; margin-left: 7px"> {{ trans('messages.resend-OTP') }}</a>
@endsection

@section('script')
<script>
    const inputFields = document.querySelectorAll('.input-otp');
  
    inputFields.forEach((input, index) => {
      input.addEventListener('input', () => {
        const maxLength = parseInt(input.getAttribute('maxlength'));
        const currentLength = input.value.length;
  
        if (currentLength >= maxLength) {
          if (index < inputFields.length - 1) {
            inputFields[index + 1].focus();
          }
        }
      });
    });
</script>
@endsection

@if ($errors->has('message'))
    <script>
        alert('{{ $errors->first('message') }}');
    </script>
@endif