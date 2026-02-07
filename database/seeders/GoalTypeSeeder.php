<?php

namespace Database\Seeders;

use App\Models\GoalType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalTypeSeeder extends Seeder
{
    private array $goals = [
        [
            'type' => 'Похудение',
            'description' => 'Снижение веса, уменьшение жировой массы',
            'calorie_modifier' => 0.8, // -20% от поддерживающих калорий
        ],
        [
            'type' => 'Поддержание веса',
            'description' => 'Сохранение текущего веса и формы',
            'calorie_modifier' => 1.0, // 100% от поддерживающих калорий
        ],
        [
            'type' => 'Набор массы',
            'description' => 'Увеличение мышечной массы',
            'calorie_modifier' => 1.2, // +20% от поддерживающих калорий
        ],
        [
            'type' => 'Сушка',
            'description' => 'Сжигание жира при сохранении мышц',
            'calorie_modifier' => 0.75, // -25% от поддерживающих калорий
        ],
        [
            'type' => 'Улучшение здоровья',
            'description' => 'Улучшение общего состояния здоровья',
            'calorie_modifier' => 0.9, // -10% от поддерживающих калорий
        ],
    ];
    public function run(): void
    {
        foreach ($this->goals as $goal) {
            GoalType::create($goal);
        }
    }
}
