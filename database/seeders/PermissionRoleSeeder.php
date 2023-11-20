<?php

namespace Database\Seeders;

use App\Models\Menu;
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
