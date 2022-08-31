<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|min:8|confirmed|required_with:password_confirmation',
            'password_confirmation' => 'min:8'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The name user is required',
            'name.max' => 'The name user is too long, please try again',
            'email.max'=>'The email is too long, please try again',
            'email.required' => 'The email is required',
            'email.unique' => 'The email is already',
            'password.min' => 'Password must be 8 characters or more',
            'password_confirmation' => 'Confirm password must be 8 characters or more'
        ];        
    }
}
