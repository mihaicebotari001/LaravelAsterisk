<?php

namespace traian321\TaskManager\Laravel;

use Illuminate\Support\ServiceProvider;
use traian321\TaskManager\config\taskmanager;
use Config;
use traian321\TaskManager\Console\ProcessCommand;

class TaskManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     * - Get all the routes
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__. '/../routes/routes.php');
        $this->loadViewsFrom(__DIR__. '/../resources/views', 'TaskManager');
        $this->mergeConfigFrom(__DIR__. '/../config/taskmanager.php', 'TaskManager');

        $this->publishes([
            __DIR__. '/../config/taskmanager.php' => config_path('TaskManager.php'),
        ]);

        $this->publishes([
            __DIR__ . '/../resources/js/components/TaskManager.vue' => config_path() . '/../resources/js/components/TaskManager.vue',
        ], 'taskmanager-vue-component');
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