<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CouponRequest extends FormRequest
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
            'coupon_name' => 'required|string|max:255',
            'coupon_code' => 'required|string|unique:coupons|max:255',
            'coupon_time' => 'required',
            'coupon_condition' => 'required',
            'coupon_number' => 'required',
        ];
    }
    public function messages(){
        return [
            'coupon_name.required' => 'The name coupon is required',
            'coupon_code.required' => 'The coupon code is required',
            'coupon_code.unique' => 'The coupon code is already, please try again',
            'coupon_time.required' => 'The coupon time is required',
            'coupon_condition.required' => 'The coupon condition is required',
            'coupon_number.required' => 'The coupon number is required',
        ];
    }
}
