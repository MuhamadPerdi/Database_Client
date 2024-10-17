<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Configurasi;
use Illuminate\Support\Facades\View;

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
        $konfigurasi = Configurasi::first();
        
        // Bagikan ke semua view
        View::share('konfigurasi', $konfigurasi);
    }
}
