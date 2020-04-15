<?php

namespace Phobo\Broth;

use Illuminate\Support\ServiceProvider;

class BrothServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            Console\ModuleMake::class,
            Console\ControllerMake::class,
            Console\RepositoryMake::class,
            Console\ModelMake::class,
            Console\ResourceMake::class
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
