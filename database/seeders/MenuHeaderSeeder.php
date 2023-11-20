<?php

namespace Database\Seeders;

use App\Models\MenuHeader;
use Illuminate\Database\Seeder;

class MenuHeaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuHeader::updateOrCreate([
            'code' => 'ACCESS',
            'name' => 'Access',
            'description' => 'Show access menu',
        ]);
        MenuHeader::updateOrCreate([
            'code' => 'MENU_NAVIGATION',
            'name' => 'Menu And Navigation',
            'description' => 'Show menu and navigation setting',
        ]);
        MenuHeader::updateOrCreate([
            'code' => 'MAIN',
            'name' => 'Main',
            'description' => 'Show main menu',
        ]);
    }
}
