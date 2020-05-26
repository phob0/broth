<?php

namespace Phobo\Broth;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

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


        //Routes

        $this->publishes([
            __DIR__.'/../laravel/routes/api.php' => base_path().'/routes/api.php',
        ], 'routes');

        $this->publishes([
            __DIR__.'/../laravel/routes/web.php' => base_path().'/routes/web.php',
        ], 'routes');

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

        $this->setupMorphMap();
        self::setupCustomCache();
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
            Console\DemoMake::class,
            Console\DemoControllerMake::class,
            Console\DemoModelMake::class,
            Console\DemoPolicyMake::class,
            Console\DemoRepositoryMake::class,
            Console\DemoResourceMake::class,
            Console\ModuleMake::class,
            Console\ControllerMake::class,
            Console\RepositoryMake::class,
            Console\ModelMake::class,
            Console\PolicyMake::class,
            Console\ResourceMake::class
        ]);

        $this->registerMiddlewareGroup($this->app->router);
    }

    public function registerMiddlewareGroup(Router $router)
    {
        $middleware_class = config('broth.api_route_middleware');

        foreach($middleware_class as $type) {

            if($type === 'push') {
                if (!is_array($type)) {
                    $router->pushMiddlewareToGroup('api', $type);

                    return;
                }

                foreach ($type as $class) {
                    $router->pushMiddlewareToGroup('api', $class);
                }
            } else {
                if (!is_array($type)) {
                    $router->prependMiddlewareToGroup('api', $type);

                    return;
                }

                foreach ($type as $class) {
                    $router->prependMiddlewareToGroup('api', $class);
                }
            }
        }
        
    }

    private function setupMorphMap()
    {
        Relation::morphMap([
            'user' => \App\User::class,
        ]);
    }

    public static function setupCustomCache()
    {
        Cache::extend('tagged_file', function ($app) {
            return Cache::repository(new TaggedFile($app['files'], $app['config']['cache.stores.tagged_file']['path']));
        });
    }
}
