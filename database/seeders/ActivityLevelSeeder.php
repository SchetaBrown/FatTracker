<?php

namespace Database\Seeders;

use App\Models\ActivityLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityLevelSeeder extends Seeder
{
    private array $activities = [
        [
            'level' => 'Сидячий образ жизни',
            'description' => 'Минимальная физическая активность, офисная работа',
            'multiplier' => 1.2,
        ],
        [
            'level' => 'Низкая активность',
            'description' => 'Легкие тренировки 1-3 раза в неделю',
            'multiplier' => 1.375,
        ],
        [
            'level' => 'Умеренная активность',
            'description' => 'Тренировки 3-5 раз в неделю',
            'multiplier' => 1.55,
        ],
        [
            'level' => 'Высокая активность',
            'description' => 'Интенсивные тренировки 6-7 раз в неделю',
            'multiplier' => 1.725,
        ],
        [
            'level' => 'Очень высокая активность',
            'description' => 'Тяжелая физическая работа + ежедневные тренировки',
            'multiplier' => 1.9,
        ],
    ];
    public function run(): void
    {
        foreach ($this->activities as $activity) {
            ActivityLevel::create($activity);
        }
    }
}
