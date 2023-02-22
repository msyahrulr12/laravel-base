<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardOfManagement extends Model
{
    use HasFactory;

    protected $table = 'board_of_managements';

    protected $fillable = [
        'code',
        'title',
        'image',
        'content',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
