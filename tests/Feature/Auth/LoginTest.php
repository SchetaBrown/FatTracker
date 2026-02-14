<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Gender;
use App\Models\GoalType;
use App\Models\ActivityLevel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_get_login_page()
    {
        $response = $this->get('/');

        $response->assertRedirect(route('login.create'));
    }

    public function test_user_can_login_with_success_credentials()
    {
        $role = Role::create(['role' => 'admin']);
        $gender = Gender::create(['gender' => 'Мужчина']);
        $activityLevel = ActivityLevel::create([
            'level' => 'Высокая активность',
            'description' => 'Интенсивные тренировки 6-7 раз в неделю',
            'multiplier' => 1.725,
        ]);
        $goalType = GoalType::create([
            'type' => 'Поддержание веса',
            'description' => 'Сохранение текущего веса и формы',
            'calorie_modifier' => 1.0,
        ]);

        User::create([
            'login' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123123123'),
            'age' => 24,
            'height' => 193,
            'weight' => 93,
            'role_id' => $role->id,
            'gender_id' => $gender->id,
            'activity_level_id' => $activityLevel->id,
            'goal_type_id' => $goalType->id,
            'normal_calories' => 3840,
        ]);

        $response = $this->post(
            route('login.store'),
            [
                'login' => 'Admin',
                'password' => '123123123',
            ]
        );

        $response->assertStatus(302);
        $response->assertRedirect(route('index'));
        $this->assertAuthenticated();
    }
}
