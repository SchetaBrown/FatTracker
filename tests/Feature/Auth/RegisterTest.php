<?php

namespace Tests\Feature\Auth;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Gender;
use App\Models\GoalType;
use App\Models\ActivityLevel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_register_page()
    {
        Role::create(['role' => 'user']);
        Role::create(['role' => 'admin']);

        Gender::create(['gender' => 'Мужчина']);
        Gender::create(['gender' => 'Женщина']);

        ActivityLevel::create([
            'level' => 'Высокая активность',
            'description' => 'Интенсивные тренировки 6-7 раз в неделю',
            'multiplier' => 1.725,
        ]);

        ActivityLevel::create([
            'level' => 'Очень высокая активность',
            'description' => 'Тяжелая физическая работа + ежедневные тренировки',
            'multiplier' => 1.9,
        ]);

        GoalType::create([
            'type' => 'Похудение',
            'description' => 'Снижение веса, уменьшение жировой массы',
            'calorie_modifier' => 0.8,
        ]);

        GoalType::create([
            'type' => 'Поддержание веса',
            'description' => 'Сохранение текущего веса и формы',
            'calorie_modifier' => 1.0,
        ]);

        $response = $this->get(route("register.create"));
        $response->assertSuccessful();
    }

    public function test_register_user_with_success_credentials()
    {
        $role = Role::create(['role' => 'user']);
        $gender = Gender::create(['gender' => 'Мужчина']);
        $activityLevel = ActivityLevel::create([
            'level' => 'Умеренная',
            'description' => 'test',
            'multiplier' => 1.55
        ]);
        $goalType = GoalType::create([
            'type' => 'Похудение',
            'description' => 'test',
            'calorie_modifier' => 0.8
        ]);

        $test_user = [
            'login' => 'user' . time(),
            'email' => 'user' . time() . '@gmail.com',
            'password' => '123123123',
            'age' => 24,
            'height' => 178,
            'weight' => 63,
            'role_id' => $role->id,
            'gender_id' => $gender->id,
            'activity_level_id' => $activityLevel->id,
            'goal_type_id' => $goalType->id,
        ];

        $response = $this->post(route('register.store'), $test_user);

        if (session()->has('errors')) {
            dd('Ошибки валидации:', session()->get('errors')->all());
        }

        if (session()->has('error')) {
            dd('Ошибка при регистрации:', session()->get('error'));
        }

        $response->assertRedirect(route('index'));

        $this->assertDatabaseHas('users', [
            'email' => $test_user['email']
        ]);

        $user = User::where('email', $test_user['email'])->first();
        $this->assertNotNull($user, 'Пользователь должен быть в БД');

        $this->assertAuthenticated();

        $this->assertNotNull($user->normal_calories, 'Должны быть рассчитаны калории');
    }
}
