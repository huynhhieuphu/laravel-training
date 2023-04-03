<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composer\ProfileComposer;

class ViewComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('profile', ProfileComposer::class);

        view::composer('dashboard', function($view) {
           return $view->with('email', 'huynhhieu.phu@gmail.com');
        });
    }
}
