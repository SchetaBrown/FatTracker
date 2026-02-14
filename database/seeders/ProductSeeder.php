<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // Получаем ID категорий
        $categories = ProductCategory::pluck('id', 'category')->toArray();

        $products = [
            // Овощи (г)
            [
                'title' => 'Огурец свежий',
                'description' => 'Свежий огурец',
                'calories' => 15,
                'protein' => 0.8,
                'fat' => 0.1,
                'carbs' => 3.0,
                'product_category_id' => $categories['Овощи'],
            ],
            [
                'title' => 'Помидор',
                'description' => 'Свежий помидор',
                'calories' => 20,
                'protein' => 0.9,
                'fat' => 0.2,
                'carbs' => 4.2,
                'product_category_id' => $categories['Овощи'],
            ],
            [
                'title' => 'Картофель вареный',
                'description' => 'Картофель отварной без соли',
                'calories' => 86,
                'protein' => 1.7,
                'fat' => 0.1,
                'carbs' => 20.1,
                'product_category_id' => $categories['Овощи'],
            ],
            [
                'title' => 'Морковь сырая',
                'description' => 'Свежая морковь',
                'calories' => 41,
                'protein' => 0.9,
                'fat' => 0.2,
                'carbs' => 9.6,
                'product_category_id' => $categories['Овощи'],
            ],

            // Фрукты (г)
            [
                'title' => 'Яблоко',
                'description' => 'Яблоко свежее',
                'calories' => 52,
                'protein' => 0.3,
                'fat' => 0.2,
                'carbs' => 14,
                'product_category_id' => $categories['Фрукты'],
            ],
            [
                'title' => 'Банан',
                'description' => 'Спелый банан',
                'calories' => 96,
                'protein' => 1.5,
                'fat' => 0.5,
                'carbs' => 21,
                'product_category_id' => $categories['Фрукты'],
            ],
            [
                'title' => 'Апельсин',
                'description' => 'Свежий апельсин',
                'calories' => 47,
                'protein' => 0.9,
                'fat' => 0.1,
                'carbs' => 12,
                'product_category_id' => $categories['Фрукты'],
            ],

            // Мясо и птица (г)
            [
                'title' => 'Куриная грудка',
                'description' => 'Филе куриной грудки без кожи',
                'calories' => 165,
                'protein' => 31,
                'fat' => 3.6,
                'carbs' => 0,
                'product_category_id' => $categories['Мясо и птица'],
            ],
            [
                'title' => 'Говядина постная',
                'description' => 'Постная говядина',
                'calories' => 250,
                'protein' => 26,
                'fat' => 15,
                'carbs' => 0,
                'product_category_id' => $categories['Мясо и птица'],
            ],
            [
                'title' => 'Яйцо куриное',
                'description' => 'Куриное яйцо среднего размера',
                'calories' => 155,
                'protein' => 13,
                'fat' => 11,
                'carbs' => 1.1,
                'product_category_id' => $categories['Мясо и птица'],
            ],

            // Рыба и морепродукты (г)
            [
                'title' => 'Лосось',
                'description' => 'Филе лосося',
                'calories' => 208,
                'protein' => 20,
                'fat' => 13,
                'carbs' => 0,
                'product_category_id' => $categories['Рыба и морепродукты'],
            ],
            [
                'title' => 'Креветки',
                'description' => 'Креветки вареные',
                'calories' => 99,
                'protein' => 24,
                'fat' => 0.3,
                'carbs' => 0.2,
                'product_category_id' => $categories['Рыба и морепродукты'],
            ],

            // Молочные продукты
            [
                'title' => 'Творог 5%',
                'description' => 'Творог средней жирности',
                'calories' => 121,
                'protein' => 17,
                'fat' => 5,
                'carbs' => 1.8,
                'product_category_id' => $categories['Молочные продукты'],
            ],
            [
                'title' => 'Молоко 2.5%',
                'description' => 'Пастеризованное молоко',
                'calories' => 52,
                'protein' => 2.8,
                'fat' => 2.5,
                'carbs' => 4.7,
                'product_category_id' => $categories['Молочные продукты'],
            ],
            [
                'title' => 'Кефир 2.5%',
                'description' => 'Кефир средней жирности',
                'calories' => 53,
                'protein' => 2.9,
                'fat' => 2.5,
                'carbs' => 4.0,
                'product_category_id' => $categories['Молочные продукты'],
            ],

            // Крупы и зерновые (г)
            [
                'title' => 'Гречка вареная',
                'description' => 'Гречневая крупа отварная',
                'calories' => 101,
                'protein' => 4.2,
                'fat' => 1.1,
                'carbs' => 21.3,
                'product_category_id' => $categories['Крупы и зерновые'],
            ],
            [
                'title' => 'Рис белый вареный',
                'description' => 'Отварной белый рис',
                'calories' => 130,
                'protein' => 2.7,
                'fat' => 0.3,
                'carbs' => 28.2,
                'product_category_id' => $categories['Крупы и зерновые'],
            ],
            [
                'title' => 'Овсянка на воде',
                'description' => 'Овсяные хлопья на воде',
                'calories' => 88,
                'protein' => 3.0,
                'fat' => 1.7,
                'carbs' => 15.0,
                'product_category_id' => $categories['Крупы и зерновые'],
            ],

            // Бобовые (г)
            [
                'title' => 'Чечевица вареная',
                'description' => 'Чечевица отварная',
                'calories' => 116,
                'protein' => 9,
                'fat' => 0.4,
                'carbs' => 20,
                'product_category_id' => $categories['Бобовые'],
            ],

            // Орехи и семена (г)
            [
                'title' => 'Миндаль',
                'description' => 'Сырой миндаль',
                'calories' => 579,
                'protein' => 21,
                'fat' => 49,
                'carbs' => 22,
                'product_category_id' => $categories['Орехи и семена'],
            ],
            [
                'title' => 'Грецкий орех',
                'description' => 'Ядра грецкого ореха',
                'calories' => 654,
                'protein' => 15,
                'fat' => 65,
                'carbs' => 14,
                'product_category_id' => $categories['Орехи и семена'],
            ],

            // Масла и жиры
            [
                'title' => 'Оливковое масло',
                'description' => 'Рафинированное оливковое масло',
                'calories' => 884,
                'protein' => 0,
                'fat' => 100,
                'carbs' => 0,
                'product_category_id' => $categories['Масла и жиры'],
            ],

            // Сладости и десерты (г)
            [
                'title' => 'Шоколад молочный',
                'description' => 'Молочный шоколад',
                'calories' => 535,
                'protein' => 7.7,
                'fat' => 29.7,
                'carbs' => 59.4,
                'product_category_id' => $categories['Сладости и десерты'],
            ],

            // Напитки (мл)
            [
                'title' => 'Вода питьевая',
                'description' => 'Чистая питьевая вода',
                'calories' => 0,
                'protein' => 0,
                'fat' => 0,
                'carbs' => 0,
                'product_category_id' => $categories['Напитки'],
            ],
            [
                'title' => 'Чай черный без сахара',
                'description' => 'Чай без добавок',
                'calories' => 1,
                'protein' => 0.1,
                'fat' => 0,
                'carbs' => 0.3,
                'product_category_id' => $categories['Напитки'],
            ],
            [
                'title' => 'Кофе черный без сахара',
                'description' => 'Натуральный кофе',
                'calories' => 2,
                'protein' => 0.2,
                'fat' => 0,
                'carbs' => 0.3,
                'product_category_id' => $categories['Напитки'],
            ],

            // Другое
            [
                'title' => 'Хлеб пшеничный',
                'description' => 'Белый пшеничный хлеб',
                'calories' => 265,
                'protein' => 9,
                'fat' => 3,
                'carbs' => 49,
                'product_category_id' => $categories['Другое'],
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
