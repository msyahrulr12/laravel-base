<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // login
        Permission::updateOrCreate(['name' => 'login auth']);
        Permission::updateOrCreate(['name' => 'logout auth']);

        // roles
        Permission::updateOrCreate(['name' => 'list roles']);
        Permission::updateOrCreate(['name' => 'show roles']);
        Permission::updateOrCreate(['name' => 'create roles']);
        Permission::updateOrCreate(['name' => 'update roles']);
        Permission::updateOrCreate(['name' => 'delete roles']);

        // permissions
        Permission::updateOrCreate(['name' => 'list permissions']);
        Permission::updateOrCreate(['name' => 'show permissions']);
        Permission::updateOrCreate(['name' => 'create permissions']);
        Permission::updateOrCreate(['name' => 'update permissions']);
        Permission::updateOrCreate(['name' => 'delete permissions']);

        // menus
        Permission::updateOrCreate(['name' => 'list menus']);
        Permission::updateOrCreate(['name' => 'show menus']);
        Permission::updateOrCreate(['name' => 'create menus']);
        Permission::updateOrCreate(['name' => 'update menus']);
        Permission::updateOrCreate(['name' => 'delete menus']);

        // menu_role
        Permission::updateOrCreate(['name' => 'list menu_role']);
        Permission::updateOrCreate(['name' => 'show menu_role']);
        Permission::updateOrCreate(['name' => 'create menu_role']);
        Permission::updateOrCreate(['name' => 'update menu_role']);
        Permission::updateOrCreate(['name' => 'delete menu_role']);
    }
}
