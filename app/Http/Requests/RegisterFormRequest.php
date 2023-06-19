<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
{

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'newPassword' => 'required|min:6',
            'cfPassword' => 'required|same:newPassword',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('messages.name_required'),
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_email'),
            'newPassword.required' => __('messages.new_password_required'),
            'newPassword.min' => __('messages.new_password_min'),
            'cfPassword.required' => __('messages.cf_password_required'),
            'cfPassword.same' => __('messages.cf_password_same'),
            'email.unique' => __('messages.email_registered'),
        ];
    }
}
