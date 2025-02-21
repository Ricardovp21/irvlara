<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Conekta\Conekta;

class ConektaServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Configurar la clave de API de Conekta
        Conekta::setApiKey(config('services.conekta.secret_key'));
        Conekta::setApiVersion("2.0.0");
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}