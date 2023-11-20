<?php

namespace Database\Seeders;

use App\Models\Menu;
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
        $roleMenu = Menu::where('code', 'ROLE')->first();
        $permissionMenu = Menu::where('code', 'PERMISSION')->first();
        $menuMenu = Menu::where('code', 'MENU')->first();
        $menuRoleMenu = Menu::where('code', 'MENU_ROLE')->first();
        $userMenu = Menu::where('code', 'USER')->first();
        $dashboardMenu = Menu::where('code', 'DASHBOARD')->first();
        $menuHeader = Menu::where('code', 'MENU_HEADER')->first();

         // login
        Permission::updateOrCreate([
            'name' => 'login auth',
            'menu_id' => null,
        ]);

         // roles
        Permission::updateOrCreate([
            'name' => 'list roles',
            'menu_id' => $roleMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'show roles',
            'menu_id' => $roleMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'create roles',
            'menu_id' => $roleMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'update roles',
            'menu_id' => $roleMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'delete roles',
            'menu_id' => $roleMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'export roles',
            'menu_id' => $roleMenu->id,
        ]);

         // permissions
        Permission::updateOrCreate([
            'name' => 'list permissions',
            'menu_id' => $permissionMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'show permissions',
            'menu_id' => $permissionMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'create permissions',
            'menu_id' => $permissionMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'update permissions',
            'menu_id' => $permissionMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'delete permissions',
            'menu_id' => $permissionMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'export permissions',
            'menu_id' => $permissionMenu->id,
        ]);

         // menus
        Permission::updateOrCreate([
            'name' => 'list menus',
            'menu_id' => $menuMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'show menus',
            'menu_id' => $menuMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'create menus',
            'menu_id' => $menuMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'update menus',
            'menu_id' => $menuMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'delete menus',
            'menu_id' => $menuMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'export menus',
            'menu_id' => $menuMenu->id,
        ]);

         // menu_role
        Permission::updateOrCreate([
            'name' => 'list menu_role',
            'menu_id' => null,
        ]);
        Permission::updateOrCreate([
            'name' => 'show menu_role',
            'menu_id' => null,
        ]);
        Permission::updateOrCreate([
            'name' => 'create menu_role',
            'menu_id' => null,
        ]);
        Permission::updateOrCreate([
            'name' => 'update menu_role',
            'menu_id' => null,
        ]);
        Permission::updateOrCreate([
            'name' => 'delete menu_role',
            'menu_id' => null,
        ]);
        Permission::updateOrCreate([
            'name' => 'export menu_role',
            'menu_id' => null,
        ]);

         // users
        Permission::updateOrCreate([
            'name' => 'list users',
            'menu_id' => $userMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'show users',
            'menu_id' => $userMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'create users',
            'menu_id' => $userMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'update users',
            'menu_id' => $userMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'delete users',
            'menu_id' => $userMenu->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'export users',
            'menu_id' => $userMenu->id,
        ]);

         // dashboard
        Permission::updateOrCreate([
            'name' => 'home dashboard',
            'menu_id' => $dashboardMenu->id,
        ]);

        // users
        Permission::updateOrCreate([
            'name' => 'list menu_headers',
            'menu_id' => $menuHeader->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'show menu_headers',
            'menu_id' => $menuHeader->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'create menu_headers',
            'menu_id' => $menuHeader->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'update menu_headers',
            'menu_id' => $menuHeader->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'delete menu_headers',
            'menu_id' => $menuHeader->id,
        ]);
        Permission::updateOrCreate([
            'name' => 'export menu_headers',
            'menu_id' => $menuHeader->id,
        ]);
    }
}
