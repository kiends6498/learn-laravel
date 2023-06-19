<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailFormRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users,email',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('messages.email_required'),
            'email.email' => __('messages.email_email'),
            'email.exists' => __('messages.email_not_register'),
        ];
    }
}
