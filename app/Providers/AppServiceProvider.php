<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Public\Kontak; 

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('kontaks', Kontak::all());
        });
    }
}