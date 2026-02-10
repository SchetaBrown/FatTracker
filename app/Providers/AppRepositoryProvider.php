<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MealRepository;
use App\Repositories\UserRepository;
use App\Repositories\ProductRepository;
use App\Repositories\UserRecordRepository;
use App\Repositories\Interfaces\MealRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\UserRecordRepositoryInterface;

class AppRepositoryProvider extends ServiceProvider
{
    const BINDINS = [
        MealRepositoryInterface::class => MealRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        UserRepositoryInterface::class => UserRepository::class,
        UserRecordRepositoryInterface::class => UserRecordRepository::class,
    ];
    public function register(): void
    {
        foreach (self::BINDINS as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
