<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

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
        Blade::directive('datetime', function ($expression) {
            $expression = trim($expression, '\'');
            $expression = trim($expression, '"');
            $time = strtotime($expression);
            $newFormat = date('d/m/Y H:i:s', $time);
            if(!empty($newFormat)) {
                return $newFormat;
            }
            return false;
        });

        Blade::if('env', function ($value) {
            if(config('app.env') === $value) {
                return true;
            }
            return false;
        });
    }
}
