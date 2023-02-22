<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisionMission extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner',
        'vision_banner',
        'vision_content',
        'mission_banner',
        'mission_content',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
