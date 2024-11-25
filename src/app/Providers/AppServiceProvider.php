<?php

namespace App\Providers;

use App\Modules\SentEmails\Repository\Contracts\SentEmailRepositoryContract;
use App\Modules\SentEmails\Repository\SentEmailRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind(SentEmailRepositoryContract::class, SentEmailRepository::class);
    }
}
