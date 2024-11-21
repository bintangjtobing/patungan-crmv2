<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\KredentailObserver;
use App\Models\KredentialCustomer;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

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

    // Cek apakah koneksi database tersedia
    if (Schema::hasTable('kredential_customers')) {
            DB::statement("SET SESSION sql_mode=(SELECT REPLACE(@@SESSION.sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        }
    }
}