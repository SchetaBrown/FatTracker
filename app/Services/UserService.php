<?php

namespace App\Services;

use App\Models\User;
use App\Services\Interfaces\UserServiceInterface;

class UserService implements UserServiceInterface
{
    const WEIGHT_CONSTANT = 10;
    const HEIGHT_CONSTANT = 6.25;
    const AGE_CONSTANT = 5;
    const MAN_CONSTANT = 5;
    const WOMAN_CONSTANT = 161;
    const PROTEIN_CALORIES_PER_GRAM = 4;
    const FAT_CALORIES_PER_GRAM = 9;
    const CARB_CALORIES_PER_GRAM = 4;

    public function setUserNormalCalories(User $user)
    {
        $weight = $user->weight;
        $height = $user->height;
        $age = $user->age;
        $gender = $user->gender->gender;
        $activityLevel = $user->activityLevel->multiplier;
        $goal = $user->goalType->calorie_modifier;

        $BMR = self::WEIGHT_CONSTANT * $weight + self::HEIGHT_CONSTANT * $height - self::AGE_CONSTANT * $age;

        $gender === 'Мужчина' ? $$BMR += self::MAN_CONSTANT : $BMR -= self::WOMAN_CONSTANT;

        $user->update([
            'normal_calories' => round($BMR * $activityLevel * $goal, 0),
        ]);
    }
}
