<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required | between:2,12',
            'MailAddress' => 'required | between:4,30 | unique:users,mail | email',
            'Password' => 'required | string | between:4,12 | unique:users,password',
            'Password confirm' => 'required | string | between:4,12 | unique:users,password | same:Password',
            'images' => 'required | file | image | mimes:jpeg,png,jpg,gif | max:2048'
        ];
    }
}
