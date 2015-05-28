<?php namespace Ixudra\Authentication;


use Illuminate\Support\ServiceProvider;

class AuthenticationServiceProvider extends ServiceProvider {

    protected $defer = false;


    public function boot()
    {
        $this->loadTranslationsFrom( __DIR__ .'/../../resources/lang', 'authentication' );
        $this->loadViewsFrom( __DIR__ .'/../../resources/views', 'authentication' );

        $this->mergeConfigFrom(
            __DIR__ .'/../../config/acl.php', 'acl'
        );

        // Publish language files
        $this->publishes(array(
            __DIR__ .'/../../resources/lang'                => base_path('resources/lang'),
        ));

        // Publish views
        $this->publishes(array(
            __DIR__ .'/../../resources/views'               => base_path('resources/views/bootstrap'),
        ));

        // Publish migrations
        $this->publishes(array(
            __DIR__ .'/../../database/migrations/'          => base_path('database/migrations')
        ), 'migrations');

        // Publish configuration files
        $this->publishes(array(
            __DIR__ .'/../../config/acl.php'                => config_path('acl.php'),
        ), 'config');

        // Load package routes
        include __DIR__ .'/../../routes.php';
        include __DIR__ .'/../../bindings.php';
    }

    public function register()
    {
        //
    }

    public function provides()
    {
        return array('authentication');
    }

}
