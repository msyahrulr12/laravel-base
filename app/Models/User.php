<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'email',
        'email_verified_at',
        'password',
        'phone_number',
        'birthplace',
        'birthdate',
        'birthplace',
        'religion',
        'education',
        'address',
        'job',
        'skill',
        'serial_number',
        'profile_image',
        'ktp_image',
        'qrcode_image',
        'card_id_image',
        'login_tried',
        'login_expired_in',
        'login_expired_in_seconds',
        'is_logged_in',
        'status',
        'is_blocked',
        'ip_address',
        'forgot_password_tried',
        'forgot_password_code',
        'forgot_password_token',
        'forgot_password_expired_at',
        'created_by',
        'updated_by',
        'deleted_by',
        'region_id',
        'member_name_image',
        'member_code_image',
        'front_card_image',
        'back_card_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public static function getCurrentSerialNumber()
    {
        $lastUser = User::orderBy('serial_number', 'desc')->first();
        $code = '';
        if ($lastUser != null) {
            $lastCode = $lastUser->serial_number;
            $splitLastCode = str_split($lastCode);

            $number = '';
            $zero = null;
            for ($i = 0; $i < sizeof($splitLastCode); $i++) {
                if ($splitLastCode[$i] == '0') {
                    $zero .= $splitLastCode[$i];
                } else {
                    $number .= $splitLastCode[$i];
                }
            }

            $code = $number + 1;

            if (strlen($code) == strlen($lastCode)) {
                $code = (string) $code;
            } else if (strlen($code) == strlen($lastCode) - 1) {
                $zero = substr($zero, 0, strlen($lastCode) - (strlen($lastCode) - 1));
                $code = $zero . $code;
            } else {
                $code = $zero . $code;
            }

        } else {
            $code = "001";
        }

        return $code;
    }
}
