<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'content',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
