<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner',
        'code',
        'title',
        'content',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}