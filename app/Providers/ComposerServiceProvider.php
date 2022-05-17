<?php

namespace App\Providers;

use App\View\Composers\SidebarVariablesComposer;
use App\View\Composers\StatisticsPageComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer('partials.sidebar', SidebarVariablesComposer::class);
        View::composer('report.index', StatisticsPageComposer::class);
    }
}
