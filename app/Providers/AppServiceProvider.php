<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {    
        //Add this custom validation rule.

        // https://stackoverflow.com/questions/34099777/laravel-5-1-validation-rule-alpha-cannot-take-whitespace
        Validator::extend('alpha_dash_spaces', function ($attribute, $value) {
    
            // If you want to accept hyphens and spaces use: /^[\pL\s-]+$/u.
            // If you want to accept whitespaces only use: /^[\pL\s]+$/u.
            // /u to force utf-8
            return preg_match('/^[\pL\s-]+$/u', $value); 
    
        });
    }
}
