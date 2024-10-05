<?php

declare(strict_types=1);

namespace App\Infrastructure;

use InvalidArgumentException;

final readonly class DatabaseConfig
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
        if (!isset($this->config['connections'][$connectionName])) {
            throw new InvalidArgumentException("Connection '{$connectionName}' not found in database configuration.");
        }

        return $this->config[$connectionName];
    }
}
