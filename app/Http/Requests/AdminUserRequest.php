<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        $is_update_password = $this->request->get('is_update_password');

        if($is_update_password == 'on') {
            return [
                'name'                  => 'required|string|max:255',
                'email'                 => 'required|email|max:255',
                'tel'                   => 'required|regex:/^[0-9]{2,4}[0-9]{2,4}[0-9]{3,4}$/',
                'password'              => 'required|alpha_num|confirmed|min:6|max:24',
                'password_confirmation' => 'required|alpha_num|min:6|max:24',
            ];
        } else {
            return [
                'name'                  => 'required|string|max:255',
                'email'                 => 'required|email|max:255',
                'tel'                   => 'required|regex:/^[0-9]{2,4}[0-9]{2,4}[0-9]{3,4}$/',
            ];
        }
        
    }

    public function messages() {
        
        return [
            'name.required' => '名前は必須です。',
            'name.string' => '名前は文字列で入力してください。',
            'name.max' => '名前は最大255文字必要です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスの書式が違います。',
            'email.max' => 'メールアドレスの長さは最大255文字です。',
            'tel.required' => '電話番号は必須です。',
            'tel.regex' => '電話番号の書式が違います。',
            'password.required' => 'パスワードは必須です。',
            'password.alpha_num' => 'パスワードはアルファベット文字と数字のみです。',
            'password.confirmed' => 'パスワードが一致しません。',
            'password.min' => 'パスワードの長さは最低6文字必要です。',
            'password.max' => 'パスワードの長さは最大24文字です。',
            'password_confirmation.required' => 'パスワード（確認）は必須です。',
            'password_confirmation.alpha_num' => 'パスワード（確認）はアルファベット文字と数字のみです。',
            'password_confirmation.min' => 'パスワード（確認）の長さは最低6文字必要です。',
            'password_confirmation.max' => 'パスワード（確認）の長さは最大24文字です。',
            
        ];
    }

}
