<?php

namespace Phobo\Broth;

use Illuminate\Support\ServiceProvider;

class BrothServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/broth.php' => config_path('broth.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../.env' => base_path('.env'),
        ], '');

        $this->publishes([__DIR__.'/../frontend' => base_path('frontend')], 'frontend');
    }

    public function register()
    {
        // register the current package
        $this->app->bind('broth', function ($app) {
            return new Broth($app);
        });

        $this->mergeConfigFrom(__DIR__.'/../config/broth.php', 'broth');

	   $this->commands([
            Console\Install::class,
            Console\ModuleMake::class,
            Console\ControllerMake::class,
            Console\RepositoryMake::class,
            Console\ModelMake::class,
            Console\ResourceMake::class
        ]);
    }
}
