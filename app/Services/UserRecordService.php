<?php

namespace App\Services;

use App\Models\Meal;
use App\Models\User;
use App\Models\UserRecord;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\UserRecordServiceInterface;
use App\Repositories\Interfaces\MealRepositoryInterface;
use Illuminate\Http\Request;

class UserRecordService implements UserRecordServiceInterface
{
    private MealRepositoryInterface $mealRepository;
    private ProductRepositoryInterface $productRepository;
    private User $user;

    const WEIGHT_CONSTANT = 10;
    const HEIGHT_CONSTANT = 6.25;
    const AGE_CONSTANT = 5;
    const MAN_CONSTANT = 5;
    const WOMAN_CONSTANT = 161;
    const PROTEIN_CALORIES_PER_GRAM = 4;
    const FAT_CALORIES_PER_GRAM = 9;
    const CARB_CALORIES_PER_GRAM = 4;

    // НАСТРОЙКИ ПО ЦЕЛЯМ (белки в г/кг)
    private const PROTEIN_PER_KG = [
        1 => 2.0,  // Похудение
        4 => 2.2,  // Сушка
        3 => 1.8,  // Набор массы
        2 => 1.6,  // Поддержание
        5 => 1.2,  // Улучшение здоровья (ближе к нормам Минздрава)
    ];

    // Проценты жиров по целям
    private const FAT_PERCENT = [
        1 => 0.25, // Похудение: 25%
        4 => 0.20, // Сушка: 20%
        3 => 0.30, // Набор: 30%
        2 => 0.25, // Поддержание: 25%
        5 => 0.30, // Здоровье: 30%
    ];

    public function __construct(MealRepositoryInterface $mealRepository, ProductRepositoryInterface $productRepository)
    {
        $this->mealRepository = $mealRepository;
        $this->user = Auth::user();
        $this->productRepository = $productRepository;
    }

    public function getDataForIndexPage()
    {
        $meals = $this->mealRepository->getMeals();
        $records = [];

        $nutrients = [
            'calories' => [
                'title' => 'Калории',
                'value' => 0,
            ],
            'protein' => [
                'title' => 'Белки',
                'value' => 0,
            ],
            'fat' => [
                'title' => 'Жиры',
                'value' => 0,
            ],
            'carbs' => [
                'title' => 'Углеводы',
                'value' => 0,
            ],
        ];

        // Формумируем массив на основе meals
        foreach ($meals as $meal) {
            $records[$meal->title] =
                UserRecord::with(['user', 'meal', 'product', 'productUnit'])
                    ->where('meal_id', $meal->id)
                    ->where('user_id', Auth::id())
                    ->orderByDesc('created_at')
                    ->get();

            foreach ($records[$meal->title] as $record) {
                $product = $record->product;
                $productFields = $record->product->only(['calories', 'fat', 'protein', 'carbs']);
                $productUnit = $record->productUnit->short_unit;
                $productQuantity = $record->quantity;
                foreach ($productFields as $key => $value) {
                    if (array_key_exists($key, $nutrients)) {
                        $nutrients[$key]['value'] +=
                            $product->$key * round(($productUnit === 'г' || $productUnit === 'мл' ? ($productQuantity / 100) : $productQuantity), 1);
                    }
                }
            }
        }

        return [
            'records' => $records,
            'nutrients' => $nutrients,
        ];
    }

    public function setUserRecord($request, $product)
    {
        try {
            if ($request->has('meal_id') || $request->has('meal')) {
                UserRecord::create([
                    'quantity' => $request->quantity,
                    'user_id' => $this->user->id,
                    'meal_id' => Meal::where('title', $request->meal_id)->orWhere('id', $request->meal_id)->first()->id,
                    'product_id' => $product->id,
                    'product_unit_id' => $request->product_unit_id,
                ]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    private function getUserNormalCalories()
    {
        $activityLevel = $this->user->activityLevel->multiplier;
        $goal = $this->user->goalType->calorie_modifier;
        $weight = $this->user->weight;
        $height = $this->user->height;
        $age = $this->user->age;

        $overallData = (self::WEIGHT_CONSTANT * $weight) +
            (self::HEIGHT_CONSTANT * $height) -
            (self::AGE_CONSTANT * $age);

        if ($this->user->gender->gender === 'Мужчина') {
            $bmr = $overallData + self::MAN_CONSTANT;
        } else {
            $bmr = $overallData - self::WOMAN_CONSTANT;
        }

        return round($bmr * $activityLevel * $goal, 0);
    }

    public function destroyProductFromDiet(UserRecord $product)
    {
        $product->delete();
    }
}
