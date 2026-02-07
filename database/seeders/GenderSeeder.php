<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    private array $genders = ['Мужчина', 'Женщина'];
    public function run(): void
    {
        foreach ($this->genders as $gender) {
            Gender::create([
                'gender' => $gender,
            ]);
        }
    }
}
