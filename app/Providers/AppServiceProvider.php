<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use phpDocumentor\Reflection\Types\Integer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('fieldType', function ($attribute, $value, $parameters, $validator) {
            switch ($parameters[0]) {
                case 'int':
                case 'float':
                    return is_numeric($value);
                case 'string':
                    return is_string($value);
                default:
                    Log::warning('Ошибочный тип поля', ['value' => $value]);
                    return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
