<?php
return [
    'host' => env('RABBITMQ_HOST'),
    'port' => env('RABBITMQ_PORT'),
    'user' => env('RABBITMQ_USER'),
    'password' => env('RABBITMQ_PASS'),
    'queries' => [
        'email' => [
            'name' => 'email',
            'no_ack' => false,
            'nowait' => false,
            'prefetch_count' => 1,
            'durable' => true,
        ],
    ],
    'exchange' => [
        'soft_svit' => [
            'name' => 'soft_svit',
            'type' => 'direct',
            'routing_key' => 'email',
        ]
    ],
];
