<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private array $users = [
        [
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => '123123123',
            'weight' => 74.3,
            'height' => 178,
            'role_id' => 1,
            'activity_' => 1,
        ]
    ];
    public function run(): void
    {
        //
    }
}
