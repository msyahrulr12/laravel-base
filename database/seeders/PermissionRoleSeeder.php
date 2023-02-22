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

        // work_programs
        $workProgramList = Permission::updateOrCreate(['name' => 'list work_programs']);
        $workProgramShow = Permission::updateOrCreate(['name' => 'show work_programs']);
        $workProgramCreate = Permission::updateOrCreate(['name' => 'create work_programs']);
        $workProgramUpdate = Permission::updateOrCreate(['name' => 'update work_programs']);
        $workProgramDelete = Permission::updateOrCreate(['name' => 'delete work_programs']);

        // documentations
        $documentationList = Permission::updateOrCreate(['name' => 'list documentations']);
        $documentationShow = Permission::updateOrCreate(['name' => 'show documentations']);
        $documentationCreate = Permission::updateOrCreate(['name' => 'create documentations']);
        $documentationUpdate = Permission::updateOrCreate(['name' => 'update documentations']);
        $documentationDelete = Permission::updateOrCreate(['name' => 'delete documentations']);

        // regulations
        $regulationList = Permission::updateOrCreate(['name' => 'list regulations']);
        $regulationShow = Permission::updateOrCreate(['name' => 'show regulations']);
        $regulationCreate = Permission::updateOrCreate(['name' => 'create regulations']);
        $regulationUpdate = Permission::updateOrCreate(['name' => 'update regulations']);
        $regulationDelete = Permission::updateOrCreate(['name' => 'delete regulations']);

        // forms
        $formList = Permission::updateOrCreate(['name' => 'list forms']);
        $formShow = Permission::updateOrCreate(['name' => 'show forms']);
        $formCreate = Permission::updateOrCreate(['name' => 'create forms']);
        $formUpdate = Permission::updateOrCreate(['name' => 'update forms']);
        $formDelete = Permission::updateOrCreate(['name' => 'delete forms']);

        // vision_missions
        $visionMissionList = Permission::updateOrCreate(['name' => 'list vision_missions']);
        $visionMissionShow = Permission::updateOrCreate(['name' => 'show vision_missions']);
        $visionMissionCreate = Permission::updateOrCreate(['name' => 'create vision_missions']);
        $visionMissionUpdate = Permission::updateOrCreate(['name' => 'update vision_missions']);
        $visionMissionDelete = Permission::updateOrCreate(['name' => 'delete vision_missions']);

        // blogs
        $blogList = Permission::updateOrCreate(['name' => 'list blogs']);
        $blogShow = Permission::updateOrCreate(['name' => 'show blogs']);
        $blogCreate = Permission::updateOrCreate(['name' => 'create blogs']);
        $blogUpdate = Permission::updateOrCreate(['name' => 'update blogs']);
        $blogDelete = Permission::updateOrCreate(['name' => 'delete blogs']);

        // board_of_managements
        $boardOfManagementList = Permission::updateOrCreate(['name' => 'list board_of_managements']);
        $boardOfManagementShow = Permission::updateOrCreate(['name' => 'show board_of_managements']);
        $boardOfManagementCreate = Permission::updateOrCreate(['name' => 'create board_of_managements']);
        $boardOfManagementUpdate = Permission::updateOrCreate(['name' => 'update board_of_managements']);
        $boardOfManagementDelete = Permission::updateOrCreate(['name' => 'delete board_of_managements']);

        // menu_role
        $menuRoleList = Permission::updateOrCreate(['name' => 'list menu_role']);
        $menuRoleShow = Permission::updateOrCreate(['name' => 'show menu_role']);
        $menuRoleCreate = Permission::updateOrCreate(['name' => 'create menu_role']);
        $menuRoleUpdate = Permission::updateOrCreate(['name' => 'update menu_role']);
        $menuRoleDelete = Permission::updateOrCreate(['name' => 'delete menu_role']);

        // regions
        $regionList = Permission::updateOrCreate(['name' => 'list regions']);
        $regionShow = Permission::updateOrCreate(['name' => 'show regions']);
        $regionCreate = Permission::updateOrCreate(['name' => 'create regions']);
        $regionUpdate = Permission::updateOrCreate(['name' => 'update regions']);
        $regionDelete = Permission::updateOrCreate(['name' => 'delete regions']);

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
