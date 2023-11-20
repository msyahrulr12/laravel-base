<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuHeader extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'description',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }
}
