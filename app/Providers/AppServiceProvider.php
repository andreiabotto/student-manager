<?php

namespace App\Providers;

use App\User\Application\Services\Interfaces\UserServiceInterface;
use App\User\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;


use App\User\Repositories\UserRepository;
use App\User\Application\Services\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
