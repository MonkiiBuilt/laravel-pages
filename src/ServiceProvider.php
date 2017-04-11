<?php
/**
 * @author Jonathon Wallen
 * @date 11/4/17
 * @time 9:46 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */

namespace MonkiiBuilt\LaravelPages;


class ServiceProvider {

    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {

        $this->loadMigrationsFrom(__DIR__.'/../resources/database/migrations');

//        $this->loadRoutesFrom(__DIR__.'/routes.php');
//
//        $this->loadViewsFrom(__DIR__.'/../resources/views', 'url-alias');

    }
}