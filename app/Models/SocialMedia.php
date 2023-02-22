<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'icon',
        'name',
        'link',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
