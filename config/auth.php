<?php

use App\Models\User;

return [
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'admin' => [                        // ← ini harus ada
            'driver' => 'session',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'admins' => [                       // ← ini harus ada
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],
    ],
    
    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
