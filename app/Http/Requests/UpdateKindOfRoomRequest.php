<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateKindofRoomRequest extends FormRequest
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
            'kindofroom_name' => 'required|string|max:255',
            'kindofroom_desc'=>'required|string|max:255',
        ];   
    }
    public function messages()
    {
        return [
            'kindofroom_name.required' => 'The name kind of room is required',
            'kindofroom_desc.required' => 'The description kind of room is required',
        ];        
    }
}
