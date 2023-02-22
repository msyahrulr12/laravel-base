<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::create([
            'code' => 10,
            'name' => 'Ciawi',
            'short_name' => 'Ciawi',
            'description' => 'Wilayah Ciawi',
        ]);
    }
}
