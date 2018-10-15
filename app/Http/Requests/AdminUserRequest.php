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
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(AdminUserRequest $request)
    {
        return [
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|string|email|max:255',
            'tel'                   => 'required|string',
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required|min:6',
        ];
        // if($request->has('is_update_password')) {
        //     return [
        //         'name'                  => 'required|string|max:255',
        //         'email'                 => 'required|string|email|max:255',
        //         'tel'                   => 'required|string',
        //         'password'              => 'required|confirmed|min:6',
        //         'password_confirmation' => 'required|min:6',
        //     ];    
        // } else {
        //     return [
        //         'name'                  => 'required|string|max:255',
        //         'email'                 => 'required|string|email|max:255',
        //         'tel'                   => 'required|string',
        //     ];
        // }
    }

    public function messages() 
    {
        return [
        ];
    }

}
