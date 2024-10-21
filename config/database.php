<?php

declare(strict_types=1);

return [
    'connections' => [
        'default' => [
            'server'        => getenv('DB_HOST'),
            'database_type' => getenv('DB_DRIVER'),
            'database_name' => getenv('DB_DATABASE'),
            'username'      => getenv('DB_USERNAME'),
            'password'      => getenv('DB_PASSWORD'),
        ],
        'unexisted_test_connection' => [
            'database_type' => 'pdo_pgsql',
            'database_name' => 'otus_other_api',
            'server'        => 'postgres',
            'username'      => 'otus',
            'password'      => 'otuspass',
        ],
    ],
];