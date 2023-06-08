<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OtpFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
            'otp1' => 'required|numeric|digits:1',
            'otp2' => 'required|numeric|digits:1',
            'otp3' => 'required|numeric|digits:1',
            'otp4' => 'required|numeric|digits:1',
            'otp5' => 'required|numeric|digits:1',
            'otp6' => 'required|numeric|digits:1',
        ];
    }

    public function messages()
    {
        return [
            'required' => __('messages.otp_required'),
            'numeric' => __('messages.otp_six_digits'),
            'digits' => __('messages.otp_six_digits'),
        ];
    }
}
