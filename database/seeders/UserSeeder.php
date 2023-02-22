<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super_admin = User::create([
            'name' => 'Super Admin',
            'code' => 'SUPER_ADMIN',
            'email' => 'super_admin@gmail.com',
            'email_verified_at' => new \DateTime(),
            'password' => bcrypt('super_admin123'),
            'phone_number' => null,
            'birthdate' => null,
            'birthplace' => null,
            'religion' => 'ISLAM',
            'education' => null,
            'address' => null,
            'job' => null,
            'skill' => null,
            'serial_number' => '001',
            'profile_image' => null,
            'ktp_image' => null,
            'qrcode_image' => null,
            'login_tried' => 0,
            'login_expired_in' => null,
            'login_expired_in_seconds' => null,
            'is_logged_in' => false,
            'status' => true,
            'is_blocked' => false,
            'ip_address' => null,
            'forgot_password_tried' => 0,
            'forgot_password_code' => null,
            'forgot_password_token' => null,
            'forgot_password_expired_at' => null,
            'created_by' => 'System',
            'updated_by' => null,
            'deleted_by' => null,
            'region_id' => 1,
        ]);
        $super_admin->assignRole('super_admin');

        $admin = User::create([
            'name' => 'Admin',
            'code' => 'ADMIN',
            'email' => 'admin@gmail.com',
            'email_verified_at' => new \DateTime(),
            'password' => bcrypt('admin123'),
            'phone_number' => null,
            'birthdate' => null,
            'birthplace' => null,
            'religion' => 'ISLAM',
            'education' => null,
            'address' => null,
            'job' => null,
            'skill' => null,
            'serial_number' => '002',
            'profile_image' => null,
            'ktp_image' => null,
            'qrcode_image' => null,
            'login_tried' => 0,
            'login_expired_in' => null,
            'login_expired_in_seconds' => null,
            'is_logged_in' => false,
            'status' => true,
            'is_blocked' => false,
            'ip_address' => null,
            'forgot_password_tried' => 0,
            'forgot_password_code' => null,
            'forgot_password_token' => null,
            'forgot_password_expired_at' => null,
            'created_by' => 'System',
            'updated_by' => null,
            'deleted_by' => null,
            'region_id' => 1,
        ]);
        $admin->assignRole('admin');

        $guest = User::create([
            'name' => 'Guest',
            'code' => 'GUEST',
            'email' => 'guest@gmail.com',
            'email_verified_at' => new \DateTime(),
            'password' => bcrypt('guest123'),
            'phone_number' => null,
            'birthdate' => null,
            'birthplace' => null,
            'religion' => 'ISLAM',
            'education' => null,
            'address' => null,
            'job' => null,
            'skill' => null,
            'serial_number' => '003',
            'profile_image' => null,
            'ktp_image' => null,
            'qrcode_image' => null,
            'login_tried' => 0,
            'login_expired_in' => null,
            'login_expired_in_seconds' => null,
            'is_logged_in' => false,
            'status' => true,
            'is_blocked' => false,
            'ip_address' => null,
            'forgot_password_tried' => 0,
            'forgot_password_code' => null,
            'forgot_password_token' => null,
            'forgot_password_expired_at' => null,
            'created_by' => 'System',
            'updated_by' => null,
            'deleted_by' => null,
            'region_id' => 1,
        ]);
        $guest->assignRole('guest');
    }
}
