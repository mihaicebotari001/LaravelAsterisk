<?php

namespace mihaicebotari001\LaravelAsterisk\Laravel;

use Illuminate\Support\ServiceProvider;
use mihaicebotari001\LaravelAsterisk\config\laravelasterisk;
use Config;
use mihaicebotari001\LaravelAsterisk\Console\ProcessCommand;

class LaravelAsteriskServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * - Get all the routes
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadRoutesFrom(__DIR__. '/../routes/routes.php');
//        $this->loadViewsFrom(__DIR__. '/../resources/views', 'LaravelAsterisk');
//        $this->mergeConfigFrom(__DIR__. '/../config/laravelasterisk.php', 'LaravelAsterisk');

//        $this->publishes([
//            __DIR__. '/../config/laravelasterisk.php' => config_path('LaravelAsterisk.php'),
//        ]);
//
//        $this->publishes([
//            __DIR__ . '/../resources/js/components/LaravelAsterisk.vue' => config_path() . '/../resources/js/components/LaravelAsterisk.vue',
//        ], 'laravelasterisk-vue-component');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->prepareResources();
        /**
         * Register commands
         */
        $this->commands([
            ProcessCommand::class
        ]);
    }

    /**
     * Prepare the package resources.
     *
     * @return void
     */
    protected function prepareResources()
    {

    }
}