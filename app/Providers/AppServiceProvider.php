<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Public\Kontak; 

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $globalKontak = Kontak::whereIn('id', [1, 2])->get();
            $view->with('globalKontak', $globalKontak);
        });
    }
}