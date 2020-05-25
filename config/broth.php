<?php


return [

    /*
    |--------------------------------------------------------------------------
    | Look & feel customizations
    |--------------------------------------------------------------------------
    |
    | Make it yours.
    |
    */

    // Project name.
    'project_name' => 'Broth',

    'api_route_middleware' => [
        'push' => [
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Barryvdh\Cors\HandleCors::class
        ],
        'prepend' => \Phobo\Broth\ExtractApiTokenFromCookie::class
    ],

    'remove_middlewares' => [
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ]
];
