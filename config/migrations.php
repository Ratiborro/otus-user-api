<?php

declare(strict_types=1);

return [
    'paths'        => [
        'migrations' => __DIR__ . '/../db/migrations',
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment'     => 'development',
        'development'             => [
            'adapter' => getenv('DB_ADAPTER'),
            'host'    => getenv('DB_HOST'),
            'name'    => getenv('DB_DATABASE'),
            'user'    => getenv('DB_USERNAME'),
            'pass'    => getenv('DB_PASSWORD'),
            'port'    => getenv('DB_PORT'),
        ],
    ],
];

