<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'name',
        'link',
        'icon',
        'menu_id',
        'created_by',
        'updated_by',
        'deleted_by',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
