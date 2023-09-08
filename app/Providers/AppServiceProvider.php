<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        Validator::extend('valid_comission', function ($attribute, $value, $parameters, $validator) {
            // Use uma expressão regular para validar a comissão
            return preg_match('/^\d+(\.\d{1,2})?$/', $value);
        });
    }
}
