<?php

declare(strict_types=1);

namespace App\Infrastructure\Db;

use InvalidArgumentException;

final readonly class DbConfig
{
    private array $config;

    public function __construct()
    {
        $this->config = require $this->getConfigPath();
    }

    private function getConfigPath(): string
    {
        return CONFIG_DIR . 'database.php';
    }

    public function getConfig(string $connectionName = 'default'): array
    {
        return $this->config['connections'][$connectionName]
            ?? throw new InvalidArgumentException("Connection '{$connectionName}' not found in database configuration.");
    }
}
