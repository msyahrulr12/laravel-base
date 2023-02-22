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

        // work_programs
        Permission::updateOrCreate(['name' => 'list work_programs']);
        Permission::updateOrCreate(['name' => 'show work_programs']);
        Permission::updateOrCreate(['name' => 'create work_programs']);
        Permission::updateOrCreate(['name' => 'update work_programs']);
        Permission::updateOrCreate(['name' => 'delete work_programs']);

        // work_programs
        Permission::updateOrCreate(['name' => 'list work_programs']);
        Permission::updateOrCreate(['name' => 'show work_programs']);
        Permission::updateOrCreate(['name' => 'create work_programs']);
        Permission::updateOrCreate(['name' => 'update work_programs']);
        Permission::updateOrCreate(['name' => 'delete work_programs']);

        // documentations
        Permission::updateOrCreate(['name' => 'list documentations']);
        Permission::updateOrCreate(['name' => 'show documentations']);
        Permission::updateOrCreate(['name' => 'create documentations']);
        Permission::updateOrCreate(['name' => 'update documentations']);
        Permission::updateOrCreate(['name' => 'delete documentations']);

        // regulations
        Permission::updateOrCreate(['name' => 'list regulations']);
        Permission::updateOrCreate(['name' => 'show regulations']);
        Permission::updateOrCreate(['name' => 'create regulations']);
        Permission::updateOrCreate(['name' => 'update regulations']);
        Permission::updateOrCreate(['name' => 'delete regulations']);

        // forms
        Permission::updateOrCreate(['name' => 'list forms']);
        Permission::updateOrCreate(['name' => 'show forms']);
        Permission::updateOrCreate(['name' => 'create forms']);
        Permission::updateOrCreate(['name' => 'update forms']);
        Permission::updateOrCreate(['name' => 'delete forms']);

        // vision_missions
        Permission::updateOrCreate(['name' => 'list vision_missions']);
        Permission::updateOrCreate(['name' => 'show vision_missions']);
        Permission::updateOrCreate(['name' => 'create vision_missions']);
        Permission::updateOrCreate(['name' => 'update vision_missions']);
        Permission::updateOrCreate(['name' => 'delete vision_missions']);

        // blogs
        Permission::updateOrCreate(['name' => 'list blogs']);
        Permission::updateOrCreate(['name' => 'show blogs']);
        Permission::updateOrCreate(['name' => 'create blogs']);
        Permission::updateOrCreate(['name' => 'update blogs']);
        Permission::updateOrCreate(['name' => 'delete blogs']);

        // board_of_managements
        Permission::updateOrCreate(['name' => 'list board_of_managements']);
        Permission::updateOrCreate(['name' => 'show board_of_managements']);
        Permission::updateOrCreate(['name' => 'create board_of_managements']);
        Permission::updateOrCreate(['name' => 'update board_of_managements']);
        Permission::updateOrCreate(['name' => 'delete board_of_managements']);

        // menu_role
        Permission::updateOrCreate(['name' => 'list menu_role']);
        Permission::updateOrCreate(['name' => 'show menu_role']);
        Permission::updateOrCreate(['name' => 'create menu_role']);
        Permission::updateOrCreate(['name' => 'update menu_role']);
        Permission::updateOrCreate(['name' => 'delete menu_role']);
    }
}
