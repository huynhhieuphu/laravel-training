<?php

namespace App\Providers;

use App\View\Components\Alert;
use App\View\Components\Inputs\Button;
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
        // Định nghĩa directive thông thường
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
        // Định nghĩa directive điều kiện rẽ nhánh
        Blade::if('env', function ($value) {
            if(config('app.env') === $value) {
                return true;
            }
            return false;
        });

        Blade::component('package-alert', Alert::class);
        Blade::component('button', Button::class);
    }
}
