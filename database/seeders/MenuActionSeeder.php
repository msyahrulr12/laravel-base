<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuAction;
use Illuminate\Database\Seeder;

class MenuActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menuRole = Menu::where('code', 'ROLE')->first();
        $menuPermission = Menu::where('code', 'PERMISSION')->first();

        MenuAction::updateOrCreate([
            'type' => 'GET',
            'name' => 'Detail',
            'link' => route('admin.roles.show', $menuRole->id),
            'icon' => 'eye',
            'menu_id' => $menuRole->id,
            'created_by' => 'system',
        ]);
        MenuAction::updateOrCreate([
            'type' => 'GET',
            'name' => 'Edit',
            'link' => route('admin.roles.edit', $menuRole->id),
            'icon' => 'edit',
            'menu_id' => $menuRole->id,
            'created_by' => 'system',
        ]);
        MenuAction::updateOrCreate([
            'type' => 'DELETE',
            'name' => 'Hapus',
            'link' => route('admin.roles.destroy', $menuRole->id),
            'icon' => 'delete',
            'menu_id' => $menuRole->id,
            'created_by' => 'system',
        ]);
    }
}
