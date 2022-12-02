<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticiesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required | max:20',
            'contents' => 'required | max:200',
        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'タイトルを入力してください',
            'title.max' => '最大20文字までです',
            'contents.required' => '質問内容を入力してください',
            'contents.max' => '最大200文字までです',
        ];
    }
}
