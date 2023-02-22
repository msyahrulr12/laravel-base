<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisionMissionCreateRequest extends FormRequest
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
            'banner' => 'required',
            'vision_banner' => 'required',
            'vision_content' => 'required',
            'mission_banner' => 'required',
            'mission_content' => 'required',
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
        ];
    }
}
