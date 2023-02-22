<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'front_background_image',
        'profile_height',
        'profile_width',
        'profile_position',
        'profile_offset_x',
        'profile_offset_y',
        'qrcode_height',
        'qrcode_width',
        'qrcode_position',
        'qrcode_offset_x',
        'qrcode_offset_y',
        'name_height',
        'name_width',
        'name_position',
        'name_offset_x',
        'name_offset_y',
        'member_code_height',
        'member_code_width',
        'member_code_position',
        'member_code_offset_x',
        'member_code_offset_y',
        'back_background_image',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
