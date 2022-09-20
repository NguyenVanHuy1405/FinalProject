<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            'arrivalDate' => 'required|after_or_equal:'.now(),
            'departureDate' => 'required|after_or_equal:'.'arrivalDate',   
        ];
    }
    public function messages(){
        return [
            'arrivalDate.required' => 'The arrivalDate is required',
            'departureDate.required' => 'The departureDate is required',
            'departureDate.after_or_equal' => 'The departure Date cannot be later than the arrivalDate',
            'arrivalDate.after_or_equal' => 'The arrival Date cannot be later than now',
        ]; 
    }
}
