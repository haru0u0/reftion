<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        \Schema::defaultStringLength(191);

        /**
         * .envファイルの(APP_ENV=production)のとき、強制https化
         */
        if (\App::environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
