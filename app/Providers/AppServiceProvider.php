<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
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
//        try {
//            DB::connection()->getPDO();
//            dump('Database is connected. Database Name is : ' . DB::connection()->getDatabaseName());
//        } catch (Exception $e) {
//            dump('Database connection failed');
//        }
        if (env('FORCE_HTTPS', false)) { // Default value should be false for local server
            URL::forceScheme('https');
        }
    }

}
