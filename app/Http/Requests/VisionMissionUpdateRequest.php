<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VisionMissionUpdateRequest extends FormRequest
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
            'banner' => '',
            'vision_banner' => '',
            'vision_content' => '',
            'mission_banner' => '',
            'mission_content' => '',
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
        ];
    }
}
