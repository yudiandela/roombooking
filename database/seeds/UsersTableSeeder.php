<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'unit_id'           => 62,
            'name'              => 'Administrator',
            'email'             => 'admin@mail.com',
            'email_verified_at' => null,
            'password'          => '$2y$10$uT6/E4vSxsXLnVn3ukvkYOFHgDkVgL0doT/Rv0naQKb1rg8qe57YG',
            'photo'             => '44b18a3af099983a0150a0419d6890e2.jpg'
        ];

        User::create($user);
    }
}
