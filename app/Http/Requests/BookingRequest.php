<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            'booking_address'=>'required|string',
            'booking_phone' =>'required|'
        ];
    }
    public function messages(){
        return[
        'booking_address.required' => 'The address is required',
        'booking_phone.required' =>'Phone number is required'
        ];
    }
}
