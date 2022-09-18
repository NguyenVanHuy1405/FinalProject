<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Captcha; 

class CustomerRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|min:8|confirmed|required_with:password_confirmation',
            'password_confirmation' => 'min:8',
            'phone' =>'required|regex:/^([0-9\s\-\+\(\)]*)$/|size:10',
            'g-recaptcha-response' => new Captcha()
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
            'password_confirmation' => 'Confirm password must be 8 characters or more',
            'phone.required' => 'The phone number is required',
            'phone.size' => 'The phone number must contain 10 characters',
            'regex' => 'The format of the phone number is not valid'
        ];        
    }

}
