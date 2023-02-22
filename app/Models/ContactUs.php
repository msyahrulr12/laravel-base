<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'phone_number',
        'email',
        'address',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];
}
