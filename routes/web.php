<?php

use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\Auth\RegisterController;
use App\Http\Controllers\Web\IndexController;
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
});

// Маршруты администратора
Route::middleware(['isAdmin'])->prefix('/admin')->name('admin.')->group(function () {

});

