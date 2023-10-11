<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;

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
        Paginator::useBootstrap();
        \URL::forceScheme('https');
        $this->app['request']->server->set('HTTPS','on');
        
        DB::listen(function ($query) {
            \Log::info("({$query->time}) $query->sql");
            \Log::info($query->bindings);
        });
    }
}
