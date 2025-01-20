<?php

return [
    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('PUSHER_APP_KEY', 'app-key'),
            'secret' => env('PUSHER_APP_SECRET', 'app-secret'),
            'app_id' => env('PUSHER_APP_ID', 'app-id'),
            'options' => [
                'host' => env('PUSHER_HOST', '127.0.0.1'),
                'port' => env('PUSHER_PORT', 6001),
                'scheme' => env('PUSHER_SCHEME', 'http'),
                'cluster' => env('PUSHER_APP_CLUSTER', 'mt1'),
                'encrypted' => env('PUSHER_SCHEME') === 'https',
                'useTLS' => env('PUSHER_SCHEME') === 'https'
            ]
        ]
    ]
];
