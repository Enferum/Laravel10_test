<?php

namespace App\Providers;

use App\Contracts\GameContract;
use App\Contracts\StorageContract;
use App\Services\LuckyNumberService;
use App\Services\RedisService;
use Illuminate\Support\ServiceProvider;
use Predis\Client as Redis;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(Redis::class, function ($app) {
            return new Redis([
                'host' => env('REDIS_HOST', '127.0.0.1'),
                'password' => env('REDIS_PASSWORD', null),
                'port' => env('REDIS_PORT', 6379),
            ]);
        });

        $this->app->bind(StorageContract::class, function () {
            return new RedisService(new Redis());
        });

        $this->app->bind(GameContract::class, function () {
            return new LuckyNumberService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
