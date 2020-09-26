<?php

use Illuminate\Database\Seeder;
use App\RoleUser;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RoleUser::truncate();
        RoleUser::create(['pru_title' => 'Super Admin']);
        RoleUser::create(['pru_title' => 'Admin']);
    }
}
