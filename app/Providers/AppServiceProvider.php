<?php

declare(strict_types=1);

namespace App\Providers;

use App\Repositories\EloquentBookRepository;
use App\Repositories\BookRepositoryInterface;
use App\Repositories\EloquentLoanRepository;
use App\Repositories\EloquentUserRepository;
use App\Repositories\LoanRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BookRepositoryInterface::class, EloquentBookRepository::class);
        $this->app->bind(UserRepositoryInterface::class, EloquentUserRepository::class);
        $this->app->bind(LoanRepositoryInterface::class, EloquentLoanRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
