<?php

namespace App\Providers;

use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\StudentRepository;
use App\Services\Interfaces\StudentServiceInterface;
use App\Services\StudentService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
        $this->app->bind(StudentServiceInterface::class, StudentService::class);
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
