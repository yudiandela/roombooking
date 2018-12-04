<?php

use Illuminate\Database\Seeder;
use App\RoleUser;

class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_user = [
            'user_id' => 1,
            'role_id' => 1
        ];

        RoleUser::create($role_user);
    }
}
