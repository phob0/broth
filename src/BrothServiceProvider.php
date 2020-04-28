<?php

namespace Phobo\Broth;

use Illuminate\Support\ServiceProvider;

class BrothServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/translatable.php' => config_path('translatable.php'),
        ], 'config');
    }
    
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

	//$this->app->register(Phobo\Broth\BrothServiceProvider::class);

    $this->mergeConfigFrom(__DIR__.'/../config/translatable.php', 'translatable');
        
	$this->commands([
            Console\ModuleMake::class,
            Console\ControllerMake::class,
            Console\RepositoryMake::class,
            Console\ModelMake::class,
            Console\ResourceMake::class
        ]);
    }
}
