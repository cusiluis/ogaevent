<?php
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'usuarios',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'usuarios',
        ],
        'asociado' => [
            'driver' => 'session',
            'provider' => 'asociados',
        ],
        
    ],

    'providers' => [
        'usuarios' => [
            'driver' => 'eloquent',
            'model' => App\Models\Usuario::class,
        ],
        'asociados' => [
            'driver' => 'eloquent',
            'model' => App\Models\Asociado::class,
        ],

    ],

    'passwords' => [
        'usuarios' => [
            'provider' => 'usuarios',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];