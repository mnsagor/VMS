<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$Rb4u5FSGPilLYxGw2Wd/K.WZxO8vFQ64VgSkjAqvv8styxrTkFHJ6',
                'remember_token' => null,
                'approved'       => 1,
            ],
        ];

        User::insert($users);

    }
}
