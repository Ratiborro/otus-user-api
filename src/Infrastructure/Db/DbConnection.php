<?php

declare(strict_types=1);

namespace App\Infrastructure\Db;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Result;

final readonly class DbConnection
{
    private Connection $connection;
    private DbConfig   $configLoader;

    public function __construct(DbConfig $configLoader)
    {
        $this->configLoader = $configLoader;
    }

    private function connect(string $connectionName = 'default'): Connection
    {
        $config = $this->configLoader->getConfig($connectionName);

        return DriverManager::getConnection([
            'dbname'   => $config['database_name'],
            'user'     => $config['username'],
            'password' => $config['password'],
            'host'     => $config['server'],
            'driver'   => $config['database_type'],
        ]);
    }

    private function getConnection(): Connection
    {
        if (!isset($this->connection)) {
            $this->connection = $this->connect();
        }

        return $this->connection;
    }

    public function executeStatement(string $sql, array $params): int
    {
        return (int) $this->getConnection()->executeStatement($sql, $params);
    }

    public function executeQuery(string $sql, array $params): Result
    {
       return $this->getConnection()->executeQuery($sql, $params);
    }
}
