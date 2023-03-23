<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => 'required',
            'code' => 'required|unique:regions',
            'email' => 'required|unique:users',
            'email_verified_at' => '',
            'password' => '',
            'phone_number' => 'required',
            'birthplace' => 'required',
            'birthdate' => 'required',
            'birthplace' => 'required',
            'religion' => 'required',
            'education' => 'required',
            'address' => 'required',
            'job' => 'required',
            'skill' => 'required',
            'serial_number' => 'required',
            'profile_image' => 'required',
            'ktp_image' => '',
            'region_id' => '',
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
