<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserRecord;
use Illuminate\Support\Facades\Auth;
use App\Services\Interfaces\UserRecordServiceInterface;
use App\Repositories\Interfaces\MealRepositoryInterface;
use Illuminate\Http\Request;

class UserRecordService implements UserRecordServiceInterface
{
    private MealRepositoryInterface $mealRepository;
    private User $user;

    public function __construct(MealRepositoryInterface $mealRepository)
    {
        $this->mealRepository = $mealRepository;
        $this->user = Auth::user();
    }

    public function getDataForIndexPage(Request $request)
    {
        $meals = $this->mealRepository->getMeals();
        $records = collect([]);
        $day = $request->has('day')
            ? $request->day
            : (session()->get('day') ?? now()->format('Y-m-d'));

        session()->put('day', $day);

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
                    ->whereDate('date', $day)
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
            'current_day' => $this->getCurrentDay($request)
        ];
    }

    private function getCurrentDay(Request $request)
    {
        if ($request->has('day')) {
            return $request->day;
        }

        return now()->format('Y-m-d');
    }
}
