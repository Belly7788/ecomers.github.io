<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Logo;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Share the logo with all views
        View::composer('*', function ($view) {
            $logo = Logo::getActiveLogo();
            $view->with('logo', $logo);
        });
    }
}
