<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    private array $users = [
        [
            'login' => 'User',
            'email' => 'user@gmail.com',
            'password' => '123123123',
            'weight' => 74.3,
            'height' => 178,
            'role_id' => 1,
            'goal_type_id' => 2,
        ],
        [
            'login' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => '123123123',
            'weight' => 78.3,
            'height' => 183,
            'role_id' => 2,
            'goal_type_id' => 4,
        ],
    ];
    public function run(): void
    {
        foreach ($this->users as $user) {
            User::create($user);
        }
    }
}
