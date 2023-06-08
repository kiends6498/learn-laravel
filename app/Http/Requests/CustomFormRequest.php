<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            //
            'newPassword' => 'required|min:6',
            'cfPassword' => 'required|same:newPassword',
        ];
    }

    public function messages()
    {
        return [
            'newPassword.required' => __('messages.new_password_required'),
            'newPassword.min' => __('messages.new_password_min'),
            'cfPassword.required' => __('messages.cf_password_required'),
            'cfPassword.same' => __('messages.cf_password_same'),
        ];
    }
}
