<?php
/**
 * @author Jonathon Wallen
 * @date 11/4/17
 * @time 9:46 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider {

    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(\MonkiiBuilt\LaravelAdministrator\PackageRegistry $packageRegistry)
    {
        $packageRegistry->registerPackage('MonkiiBuilt\LaravelPages');

        $packageRegistry->registerConfig(config_path('laravel-administrator/laravel-administrator-pages.php'));

        $this->loadMigrationsFrom(__DIR__.'/../resources/database/migrations');

        $this->loadRoutesFrom(__DIR__.'/routes.php');

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'pages');

        $this->publishes([
            __DIR__. '/../config/laravel-administrator-pages.php' => config_path('/laravel-administrator/laravel-administrator-pages.php')
        ], 'administrator-pages-config');
    }
}