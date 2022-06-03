<?php

namespace App\Providers;

use App\Constants\PermissionsConstant;
use Illuminate\Support\Facades\View;
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
        $this->initHelpers();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Initialize helpers
     * @return void
     */
    public function initHelpers()
    {
        foreach (glob(__DIR__ . '/../Helpers/*.php') as $item) {
            include $item;
        }
    }
}
