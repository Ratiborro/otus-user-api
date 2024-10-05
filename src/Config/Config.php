<?php

declare(strict_types=1);

namespace App\Config;

final readonly class Config
{
    private const CONFIG_DIR = CONFIG_DIR;
    private array $config;

    public function getConfig(string $fileName)
    {
        if (!isset($this->config)) {
            $this->config = require self::CONFIG_DIR . $fileName . '.php';
        }

        return $this->config;
    }
}