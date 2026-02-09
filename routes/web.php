<?php

use App\Http\Controllers\Web\Admin\AdminIndexController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\IndexController;
use App\Http\Controllers\Web\Product\ProductController;
use App\Http\Controllers\Web\Profile\ProfileController;
use App\Http\Controllers\Web\Setting\SettingController;
use Illuminate\Support\Facades\Route;

// Вход в систему
Route::controller(LoginController::class)->prefix('/login')->name("login.")->group(function () {
    Route::get('/', 'create')->name('create'); // Страница входа в систему
    Route::post('/store', 'store')->name("store"); // Маршрут для входа в систему
});

// Регистрация в системе
Route::controller(RegisterController::class)->prefix('/register')->name("register.")->group(function () {
    Route::get('/', 'create')->name('create'); // Страница входа в систему
    Route::post('/store', 'store')->name("store"); // Маршрут для регистрации в системе
});

// Защищенные маршруты
Route::middleware(['isAuth'])->group(function () {
    // Главная страница
    Route::get('/', [IndexController::class, 'index'])->name('index'); // Главная страница


    Route::prefix('/profile')->name('profile.')->group(function () {
        // Управление профилем
        Route::controller(ProfileController::class)->group(function () {
            Route::get('/', 'index')->name('index'); // Главная страница профиля
        });

        // Настройки
        Route::controller(SettingController::class)->prefix('/settings')->name('setting.')->group(function () {
            Route::get('/', 'index')->name('index'); // Главая страница профиля
            Route::patch('/update', 'update')->name('update'); // Обновление цели или активности
        });
    });

    // Управление продуктами
    Route::controller(ProductController::class)->prefix('/products')->name('product.')->group(function () {
        Route::get('/', 'index')->name('index'); // Просмотр всех продуктов
        Route::post('/{product}', 'store')->name('store'); // Добавление продукта к рациону
        Route::delete('/{record}', 'destroy')->name('destroy'); // Удаление продукта из рациона
    });

    // Выход из аккаунта
    Route::delete('/login/destroy', [LoginController::class, 'destroy'])->name('login.destroy');
});


// Маршруты администратора
Route::middleware(['isAdmin'])->prefix('/admin')->name('admin.')->group(function () {
    // Dashboard-страница админ-панели
    Route::get('/dashboard', AdminIndexController::class)->name('index');
});

// Резервный маршрут
Route::fallback(function () {
    return redirect()->route('index');
});

