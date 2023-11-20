<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'parent_id',
        'name',
        'description',
        'icon',
        'link',
        'menu_header_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'id');
    }

    public function role()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }

    public function menu_header()
    {
        return $this->belongsTo(MenuHeader::class);
    }

    public function menu_actions()
    {
        return $this->hasMany(MenuAction::class);
    }
}
