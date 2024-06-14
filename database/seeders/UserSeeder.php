<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'first_name' => 'Veiy',
                'last_name' => 'Sokheng',
                'phone' => '0979294797',
                'address' => 'Phnom Penh',
                'password' => '$2y$10$9pFxE4r4LCM.srMvPZ/riOPdkrrBJxCyFh.P6VOXDR/Do0KR3tQRG', // This should already be hashed
                'role_id' => 1,
                'is_verified' => 0,
                'email_verified_at' => null,
                'created_at' => '2024-04-30 09:17:23',
                'updated_at' => '2024-04-30 09:19:10'
            ],
            [
                'first_name' => 'Nani',
                'last_name' => 'Mai',
                'phone' => '0979294798',
                'address' => 'Phnom Penh',
                'password' => '$2y$10$OnytitYeqTB2mVU2.U/JX.YXMnygN3hCiDRAv2zSilcHwX4ItgDEa', // This should already be hashed
                'role_id' => 2,
                'is_verified' => 1,
                'email_verified_at' => null,
                'created_at' => '2024-04-30 09:17:48',
                'updated_at' => '2024-05-02 13:21:22'
            ],
        ]);
    }
}
