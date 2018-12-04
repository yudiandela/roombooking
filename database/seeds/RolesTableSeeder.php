<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'User has access to all system functionality'
            ],
            [
                'id' => 2,
                'name' => 'shop-keeper',
                'display_name' => 'Shop Keeper',
                'description' => 'User can create create data in the system'
            ],
            [
                'id' => 5,
                'name' => 'employee',
                'display_name' => 'Employee',
                'description' => 'Employee'
            ]
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}
