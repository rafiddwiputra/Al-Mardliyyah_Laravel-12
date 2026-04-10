<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Import ini
use App\Models\Public\Kontak;       // Import Model Kontak
use App\Models\ProfilPondok; // Import Model ProfilPondok

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Bagian ini akan mengirimkan data ke SEMUA view blade
        View::composer('*', function ($view) {
            $view->with('kontaks', Kontak::all());
            $view->with('profil', ProfilPondok::first());
        });
    }
}