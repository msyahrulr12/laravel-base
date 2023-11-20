<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roleSuperAdmin = Role::where('name', 'super_admin')->first();
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleGuest = Role::where('name', 'guest')->first();

        Menu::updateOrCreate([
            'code' => 'USER',
            'parent_id' => null,
            'name' => 'User',
            'description' => 'User setting',
            'icon' => 'user',
            'link' => route('admin.users.index'),
            'menu_header_id' => 1,
        ])->role()->sync([$roleSuperAdmin->id, $roleAdmin->id, $roleGuest->id]);
        Menu::updateOrCreate([
            'code' => 'ROLE',
            'parent_id' => null,
            'name' => 'Role',
            'description' => 'Role setting',
            'icon' => 'user',
            'link' => route('admin.roles.index'),
            'menu_header_id' => 1,
        ])->role()->sync([$roleSuperAdmin->id, $roleAdmin->id, $roleGuest->id]);
        Menu::updateOrCreate([
            'code' => 'PERMISSION',
            'parent_id' => null,
            'name' => 'Permission',
            'description' => 'Permission setting',
            'icon' => 'user-check',
            'link' => route('admin.permissions.index'),
            'menu_header_id' => 1,
        ])->role()->sync([$roleSuperAdmin->id, $roleAdmin->id, $roleGuest->id]);
        Menu::updateOrCreate([
            'code' => 'MENU_HEADER',
            'parent_id' => null,
            'name' => 'Menu Header',
            'description' => 'Menu header setting',
            'icon' => 'align-left',
            'link' => route('admin.menu_headers.index'),
            'menu_header_id' => 2,
        ])->role()->sync([$roleSuperAdmin->id, $roleAdmin->id, $roleGuest->id]);
        Menu::updateOrCreate([
            'code' => 'MENU',
            'parent_id' => null,
            'name' => 'Menu',
            'description' => 'Menu setting',
            'icon' => 'align-justify',
            'link' => route('admin.menus.index'),
            'menu_header_id' => 2,
        ])->role()->sync([$roleSuperAdmin->id, $roleAdmin->id, $roleGuest->id]);
        Menu::updateOrCreate([
            'code' => 'DASHBOARD',
            'parent_id' => null,
            'name' => 'Dashboard',
            'description' => 'Dashboard detail',
            'icon' => 'home',
            'link' => route('admin.dashboard'),
            'menu_header_id' => 3,
        ])->role()->sync([$roleSuperAdmin->id, $roleAdmin->id, $roleGuest->id]);
    }
}
