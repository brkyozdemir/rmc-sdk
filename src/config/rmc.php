<?php

// example config
return [
    'platform' => env('RMC_PLATFORM'),

    'email' => [
        'from' => [
            'name' => env('RMC_EMAIL_FROM_NAME', 'Scoutium'),
            'address' => env('RMC_EMAIL_FROM_ADDRESS', 'scoutium@euromsg.net'),
        ],
        'reply_address' => 'noreply@scoutium.com',
        'char_set' => 'utf-8',
        'post_type' => '',
        'key_id' => '',
        'custom_params' => '',
    ],

    'auth' => [
        'username' => env('RMC_USERNAME'),
        'password' => env('RMC_PASSWORD'),
    ],
];
