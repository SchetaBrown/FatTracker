<?php

namespace App\Providers;

use App\Services\Interfaces\UserServiceInterface;
use App\Services\UserRecordService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\UserRecordServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    const BINDINS = [
        UserRecordServiceInterface::class => UserRecordService::class,
        UserServiceInterface::class => UserService::class
    ];
    public function register(): void
    {
        foreach (self::BINDINS as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
