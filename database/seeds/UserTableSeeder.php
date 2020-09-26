<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\DB;
use App\RoleUser;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'pu_username' => 'superadmin',
            'pu_id_role' => '1',
            'pu_password' => Hash::make('supersuper')
        ]);
        User::create([
            'pu_username' => 'admin',
            'pu_id_role' => '2',
            'pu_password' => Hash::make('adminadmin')
        ]);
    }
}
