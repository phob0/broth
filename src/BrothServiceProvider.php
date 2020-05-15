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
            __DIR__.'/../laravel/Controllers/Controller.php' => base_path().'/app/Http/Controllers/Controller.php',
        ], 'controllers');

        $this->publishes([
            __DIR__.'/../laravel/Controllers/AppController.php' => base_path().'/app/Http/Controllers/AppController.php',
        ], 'controllers');

        $this->publishes([
            __DIR__.'/../laravel/Controllers/SettingsController.php' => base_path().'/app/Http/Controllers/SettingsController.php',
        ], 'controllers');

        $this->publishes([
            __DIR__.'/../laravel/Controllers/UserController.php' => base_path().'/app/Http/Controllers/UserController.php',
        ], 'controllers');


        //Middleware

        $this->publishes([
            __DIR__.'/../laravel/Middleware/Authenticate.php' => base_path().'/app/Http/Middleware/Authenticate.php',
        ], 'middleware');

        $this->publishes([
            __DIR__.'/../laravel/Middleware/CheckForMaintenanceMode.php' => base_path().'/app/Http/Middleware/CheckForMaintenanceMode.php',
        ], 'middleware');
        
        $this->publishes([
            __DIR__.'/../laravel/Middleware/EncryptCookies.php' => base_path().'/app/Http/Middleware/EncryptCookies.php',
        ], 'middleware');
        
        $this->publishes([
            __DIR__.'/../laravel/Middleware/ExtractApiTokenFromCookie.php' => base_path().'/app/Http/Middleware/ExtractApiTokenFromCookie.php',
        ], 'middleware');
        
        $this->publishes([
            __DIR__.'/../laravel/Middleware/RedirectIfAuthenticated.php' => base_path().'/app/Http/Middleware/RedirectIfAuthenticated.php',
        ], 'middleware');
        
        $this->publishes([
            __DIR__.'/../laravel/Middleware/TrimStrings.php' => base_path().'/app/Http/Middleware/TrimStrings.php',
        ], 'middleware');
        
        $this->publishes([
            __DIR__.'/../laravel/Middleware/TrustProxies.php' => base_path().'/app/Http/Middleware/TrustProxies.php',
        ], 'middleware');
        
        $this->publishes([
            __DIR__.'/../laravel/Middleware/VerifyCsrfToken.php' => base_path().'/app/Http/Middleware/VerifyCsrfToken.php',
        ], 'middleware');

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

        //Providers

        $this->publishes([
            __DIR__.'/../laravel/Providers/AppServiceProvider.php' => base_path().'/app/Providers/AppServiceProvider.php',
        ], 'privoder');

        $this->publishes([
            __DIR__.'/../laravel/Providers/AuthServiceProvider.php' => base_path().'/app/Providers/AuthServiceProvider.php',
        ], 'privoder');

        $this->publishes([
            __DIR__.'/../laravel/Providers/BroadcastServiceProvider.php' => base_path().'/app/Providers/BroadcastServiceProvider.php',
        ], 'privoder');

        $this->publishes([
            __DIR__.'/../laravel/Providers/EventServiceProvider.php' => base_path().'/app/Providers/EventServiceProvider.php',
        ], 'privoder');

        $this->publishes([
            __DIR__.'/../laravel/Providers/RouteServiceProvider.php' => base_path().'/app/Providers/RouteServiceProvider.php',
        ], 'privoder');

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

        $this->publishes([
            __DIR__.'/../laravel/routes/web.php' => base_path().'/routes/web.php',
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

        //Kernel

        $this->publishes([
            __DIR__.'/../laravel/Kernel.php' => base_path().'/app/Http/Kernel.php',
        ], 'kernel');

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
