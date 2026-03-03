<?php

namespace App\Providers;

use App\Models\Service;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('*', function ($view) {
            $view->with('settings', SiteSetting::instance());
            $view->with('allServices', Service::active()->services()->get());
            $view->with('currentLocale', app()->getLocale());
            $view->with('supportedLocales', ['az', 'ru', 'en']);
        });
    }
}
