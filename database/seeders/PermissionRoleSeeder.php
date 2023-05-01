<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * ======================================
         * Permission
         * ======================================
         */

         // login
        $loginAuth = Permission::updateOrCreate(['name' => 'login auth']);

        // roles
        $rolesList = Permission::updateOrCreate(['name' => 'list roles']);
        $rolesShow = Permission::updateOrCreate(['name' => 'show roles']);
        $rolesCreate = Permission::updateOrCreate(['name' => 'create roles']);
        $rolesUpdate = Permission::updateOrCreate(['name' => 'update roles']);
        $rolesDelete = Permission::updateOrCreate(['name' => 'delete roles']);

        // permissions
        $permissionList = Permission::updateOrCreate(['name' => 'list permissions']);
        $permissionShow = Permission::updateOrCreate(['name' => 'show permissions']);
        $permissionCreate = Permission::updateOrCreate(['name' => 'create permissions']);
        $permissionUpdate = Permission::updateOrCreate(['name' => 'update permissions']);
        $permissionDelete = Permission::updateOrCreate(['name' => 'delete permissions']);

        // menus
        $menuList = Permission::updateOrCreate(['name' => 'list menus']);
        $menuShow = Permission::updateOrCreate(['name' => 'show menus']);
        $menuCreate = Permission::updateOrCreate(['name' => 'create menus']);
        $menuUpdate = Permission::updateOrCreate(['name' => 'update menus']);
        $menuDelete = Permission::updateOrCreate(['name' => 'delete menus']);

        // menu_role
        $menuRoleList = Permission::updateOrCreate(['name' => 'list menu_role']);
        $menuRoleShow = Permission::updateOrCreate(['name' => 'show menu_role']);
        $menuRoleCreate = Permission::updateOrCreate(['name' => 'create menu_role']);
        $menuRoleUpdate = Permission::updateOrCreate(['name' => 'update menu_role']);
        $menuRoleDelete = Permission::updateOrCreate(['name' => 'delete menu_role']);

        // users
        $userList = Permission::updateOrCreate(['name' => 'list users']);
        $userShow = Permission::updateOrCreate(['name' => 'show users']);
        $userCreate = Permission::updateOrCreate(['name' => 'create users']);
        $userUpdate = Permission::updateOrCreate(['name' => 'update users']);
        $userDelete = Permission::updateOrCreate(['name' => 'delete users']);

        // dashboard
        $dashboardHome = Permission::updateOrCreate(['name' => 'home dashboard']);

        /**
         * ======================================
         * Role
         * ======================================
         */
        $superAdmin = Role::updateOrCreate(['name' => 'super_admin']);
        $admin = Role::updateOrCreate(['name' => 'admin']);
        $guest = Role::updateOrCreate(['name' => 'guest']);

        /**
         * ======================================
         * Assign role to permission
         * ======================================
         */
        $permissions = Permission::all();
        $superAdmin->syncPermissions($permissions);
    }
}
