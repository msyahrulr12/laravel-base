<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'title',
        'description',
        'file',
        'filename',
        'file_type',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
