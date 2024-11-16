<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\KredentailObserver;
use App\Models\KredentialCustomer;

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
        KredentialCustomer::observe(KredentailObserver::class);
    }
}
