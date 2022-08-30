<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
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
            'room_name' => 'required|string|max:50',
            'room_description'=>'required|string|max:255',
            'room_content'=>'required|string|max:255',
            'room_price'=>'required|string|max:255',
        ];   
    }
    public function messages()
    {
        return [
            'room_name.required' => 'The name room is required',
            'room_description.required' => 'The description room is required',
            'room_content.required' => 'The room content is required',
            'room_price.required' => 'The price of room is required',
        ];        
    }
}
