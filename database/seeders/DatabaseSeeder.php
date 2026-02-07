<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GenderSeeder::class,
            RoleSeeder::class,
            ActivityLevelSeeder::class,
            GoalTypeSeeder::class,
            UserSeeder::class,
            MealSeeder::class,
            ProductCategorySeeder::class,
            ProductUnitSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
