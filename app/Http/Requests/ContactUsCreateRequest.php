<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsCreateRequest extends FormRequest
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
            'code' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
            'address' => 'required',
            'description' => '',
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
        ];
    }
}