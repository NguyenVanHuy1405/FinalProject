<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KindOfRoomRequest extends FormRequest
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
            'kindofroom_name' => 'required|string|unique:kind_of_rooms|max:255',
            'kindofroom_desc'=>'required|string|max:255',
            'kindofroom_status'=>'required'
        ];   
    }
    public function messages()
    {
        return [
            'kindofroom_name.required' => 'The name kind of room is required',
            'kindofroom_name.unique' => 'The name kind of room  is already',
            'kindofroom_desc.required' => 'The description kind of room is required',
            'kindofroom_status.required' => 'The status kind of room is required',
        ];        
    }
}
