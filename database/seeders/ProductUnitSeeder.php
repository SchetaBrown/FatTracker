<?php

namespace Database\Seeders;

use App\Models\ProductUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductUnitSeeder extends Seeder
{
    private array $units = [
        ['unit' => 'Граммы', 'short_unit' => 'г',],
        ['unit' => 'Килограммы', 'short_unit' => 'кг',],
        ['unit' => 'Миллилитры', 'short_unit' => 'мл',],
        ['unit' => 'Литр', 'short_unit' => 'л',],
        ['unit' => 'Штуки', 'short_unit' => 'шт',],
        ['unit' => 'Стакан', 'short_unit' => 'ст.',],
        ['unit' => 'Столовая ложка', 'short_unit' => 'ст.л.',],
        ['unit' => 'Чайная ложка', 'short_unit' => 'ч.л.',],
    ];
    public function run(): void
    {
        foreach ($this->units as $unit) {
            ProductUnit::create($unit);
        }
    }
}
