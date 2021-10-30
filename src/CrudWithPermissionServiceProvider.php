<?php


namespace Gglink\CrudPermission;

use Illuminate\Support\ServiceProvider;

class CrudWithPermissionServiceProvider extends ServiceProvider{

    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'crudPermission');

        $this->publishes([
            __DIR__.'/../config/crud_config.php' => config_path('crud_config.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/crud_config.php', 'crudPermission'
        );
    }
}
