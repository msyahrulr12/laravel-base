<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'name' => 'required',
            'code' => [
                'required',
                Rule::unique('users')->ignore($id, 'id')
            ],
            'email' => 'required',
            'email_verified_at' => '',
            'password' => '',
            're_enter_password' => '',
            'phone_number' => 'required',
            'birthplace' => 'required',
            'birthdate' => 'required',
            'religion' => 'required',
            'education' => 'required',
            'address' => 'required',
            'job' => 'required',
            'skill' => 'required',
            'serial_number' => 'required',
            'profile_image' => '',
            'ktp_image' => '',
            'qrcode_image' => '',
            'login_tried' => '',
            'login_expired_in' => '',
            'login_expired_in_seconds' => '',
            'is_logged_in' => '',
            'status' => 'required',
            'is_blocked' => '',
            'ip_address' => '',
            'forgot_password_tried' => '',
            'forgot_password_code' => '',
            'forgot_password_token' => '',
            'forgot_password_expired_at' => '',
        ];
    }
}
