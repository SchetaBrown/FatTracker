<?php

namespace Database\Seeders;

use App\Models\Meal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MealSeeder extends Seeder
{
    private array $meals = ['завтрак', 'обед', 'полдник', 'ужин'];
    public function run(): void
    {
        foreach ($this->meals as $meal) {
            Meal::create([
                'meal' => $meal,
            ]);
        }
    }
}
