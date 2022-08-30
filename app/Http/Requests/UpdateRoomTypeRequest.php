<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomtypeRequest extends FormRequest
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
            'roomtype_name' => 'required|string|max:255',
            'roomtype_desc'=>'required|string|max:255',
        ];   
    }
    public function messages()
    {
        return [
            'roomtype_name.required' => 'The name room type is required',
            'roomtype_name.unique' => 'The name room type is already',
            'roomtype_desc.required' => 'The description room type is required',
        ];        
    }
}
