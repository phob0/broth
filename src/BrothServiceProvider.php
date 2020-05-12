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
            __DIR__.'/../config/auth.php' => config_path('auth.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/../.env' => base_path('.env'),
        ], '');

        //Traits

        $this->publishes([
            __DIR__.'/../laravel/Traits/HandlesUserRoles.php' => base_path().'/app/Traits/HandlesUserRoles.php',
        ], 'controllers');

        $this->publishes([
            __DIR__.'/../laravel/Traits/OutputsConsoleData.php' => base_path().'/app/Traits/OutputsConsoleData.php',
        ], 'controllers');

        //Controllers

        $this->publishes([
            __DIR__.'/../laravel/Controllers/AppController.php' => base_path().'/app/Http/Controllers/AppController.php',
        ], 'controllers');

        $this->publishes([
            __DIR__.'/../laravel/Controllers/SettingController.php' => base_path().'/app/Http/Controllers/SettingController.php',
        ], 'controllers');

        $this->publishes([
            __DIR__.'/../laravel/Controllers/UserController.php' => base_path().'/app/Http/Controllers/UserController.php',
        ], 'controllers');

        //Resources

        $this->publishes([
            __DIR__.'/../laravel/Resources/SettingResource.php' => base_path().'/app/Http/Resources/SettingResource.php',
        ], 'resource');

        $this->publishes([
            __DIR__.'/../laravel/Resources/UserResource.php' => base_path().'/app/Http/Resources/UserResource.php',
        ], 'resource');

        //Policies

        $this->publishes([
            __DIR__.'/../laravel/Policies/SettingPolicy.php' => base_path().'/app/Policies/SettingPolicy.php',
        ], 'policies');

        $this->publishes([
            __DIR__.'/../laravel/Policies/UserPolicy.php' => base_path().'/app/Policies/UserPolicy.php',
        ], 'policies');

        //Repositories

        $this->publishes([
            __DIR__.'/../laravel/Repositories/SettingRepository.php' => base_path().'/app/Repositories/SettingRepository.php',
        ], 'repositories');

        $this->publishes([
            __DIR__.'/../laravel/Repositories/UserRepository.php' => base_path().'/app/Repositories/UserRepository.php',
        ], 'repositories');

        //Routes

        $this->publishes([
            __DIR__.'/../laravel/routes/api.php' => base_path().'/routes/api.php',
        ], 'routes');

        //Models

        $this->publishes([
            __DIR__.'/../laravel/User.php' => base_path().'/app/User.php',
        ], 'models');

        $this->publishes([
            __DIR__.'/../laravel/UserRole.php' => base_path().'/app/UserRole.php',
        ], 'models');

        $this->publishes([
            __DIR__.'/../laravel/Setting.php' => base_path().'/app/Setting.php',
        ], 'models');

        //Migrations

        $this->publishes([
            __DIR__.'/../laravel/migrations/2014_10_12_000000_create_users_table.php' => base_path().'/database/migrations/2014_10_12_000000_create_users_table.php',
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../laravel/migrations/2019_08_07_124134_create_settings_table.php' => base_path().'/database/migrations/2019_08_07_124134_create_settings_table.php',
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../laravel/migrations/2019_08_19_182451_create_user_roles_table.php' => base_path().'/database/migrations/2019_08_19_182451_create_user_roles_table.php',
        ], 'migrations');

        //Seeder

        $this->publishes([
            __DIR__.'/../laravel/seeds/DatabaseSeeder.php' => base_path().'/database/seeds/DatabaseSeeder.php',
        ], 'seeds');

        //Frontend

        $this->publishes([__DIR__.'/../frontend' => base_path('frontend')], 'frontend');
    }

    public function register()
    {
        // register the current package
        $this->app->bind('broth', function ($app) {
            return new Broth($app);
        });

        $this->mergeConfigFrom(__DIR__.'/../config/broth.php', 'broth');

        $this->mergeConfigFrom(__DIR__.'/../config/auth.php', 'auth');

        $this->loadRoutesFrom(__DIR__.'/../laravel/routes/api.php');

        $this->loadMigrationsFrom(__DIR__.'/../laravel/migrations/2014_10_12_000000_create_users_table.php');

        $this->loadMigrationsFrom(__DIR__.'/../laravel/migrations/2019_08_07_124134_create_settings_table.php');

        $this->loadMigrationsFrom(__DIR__.'/../laravel/migrations/2019_08_19_182451_create_user_roles_table.php');

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
