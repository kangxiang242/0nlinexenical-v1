<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton('site.setting', function () {
            return new \App\Models\Config();
        });
    }

    public function boot(): void
    {
        Schema::defaultStringLength(191);
        View::addNamespace('web', resource_path('views/web'));
    }
}
