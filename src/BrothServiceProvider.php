<?php

namespace Phobo\Broth;

use Illuminate\Support\ServiceProvider;

class BrothServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/translatable.php' => config_path('translatable.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../.env' => base_path('.env'),
        ], '');

        $this->publishes([__DIR__.'/../frontend' => base_path('frontend')], 'frontend');
    }

    public function register()
    {
        if (class_exists('Phobo\Broth\BrothServiceProvider')) {
            $this->app->register('Phobo\Broth\BrothServiceProvider');
        }

        $this->mergeConfigFrom(__DIR__.'/../config/translatable.php', 'translatable');

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