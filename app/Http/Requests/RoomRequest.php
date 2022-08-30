<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
            'room_name' => 'required|string|unique:rooms|max:255',
            'room_description'=>'required|string|max:255',
            'room_content'=>'required|string|max:255',
            'room_price'=>'required|string|max:255',
            'room_image'=>'required',
            'room_status'=>'required'
        ];   
    }
    public function messages()
    {
        return [
            'room_name.required' => 'The name room is required',
            'room_name.unique' => 'The name room is already',
            'room_description.required' => 'The description room is required',
            'room_content.required' => 'The room content is required',
            'room_price.required' => 'The price of room is required',
            'room_image.required' => 'The image of room is required',
            'room_status.required' => 'The status kind of room is required',
        ];        
    }
}
