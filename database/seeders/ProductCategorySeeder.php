<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    private array $categories = [
        'Овощи',
        'Фрукты',
        'Мясо и птица',
        'Рыба и морепродукты',
        'Молочные продукты',
        'Крупы и зерновые',
        'Бобовые',
        'Орехи и семена',
        'Масла и жиры',
        'Сладости и десерты',
        'Напитки',
        'Другое'
    ];
    public function run(): void
    {
        foreach ($this->categories as $category) {
            ProductCategory::create([
                'category' => $category
            ]);
        }
    }
}
