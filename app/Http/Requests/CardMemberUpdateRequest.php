<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CardMemberUpdateRequest extends FormRequest
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
        $id = request()->segment(3);
        return [
            'code' => [
                'required',
                Rule::unique('card_members')->ignore($id, 'id')
            ],
            'front_background_image' => '',
            'profile_height' => 'required',
            'profile_width' => 'required',
            'profile_position' => 'required',
            'profile_offset_x' => 'required',
            'profile_offset_y' => 'required',
            'qrcode_height' => 'required',
            'qrcode_width' => 'required',
            'qrcode_position' => 'required',
            'qrcode_offset_x' => 'required',
            'qrcode_offset_y' => 'required',
            'name_height' => 'required',
            'name_width' => 'required',
            'name_position' => 'required',
            'name_offset_x' => 'required',
            'name_offset_y' => 'required',
            'member_code_height' => 'required',
            'member_code_width' => 'required',
            'member_code_position' => 'required',
            'member_code_offset_x' => 'required',
            'member_code_offset_y' => 'required',
            'back_background_image' => '',
            'created_by' => '',
            'updated_by' => '',
            'deleted_by' => '',
        ];
    }
}
