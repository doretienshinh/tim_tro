<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CreateUserRequest extends FormRequest
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
        $validates = [
            'name' => ['max:191'],
            'email' => ['required', 'string', 'email', 'max:191'],
            'address' => ['max:191'],
            'gender' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required'],
        ];

        return $validates;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'name.max' => '191 文字未満で入力してください',
            // 'email.required' => '有効なメールアドレスを入力してください',
            // 'email.unique' => 'メールアドレスが重複しています',
            // 'email.max' => '191 文字未満で入力してください',
            // 'address.max' => '191 文字未満で入力してください',
            // 'password.required' => 'パスワード入力してください',
            // 'password.min' => '6文字以上入力してください',
            // 'password.confirmed' => 'パスワード確認が一致しません。',
            // 'password_confirmation.required' => '確認用パスワード入力してください'
        ];
    }
}

