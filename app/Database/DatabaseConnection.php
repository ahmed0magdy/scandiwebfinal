<?php

namespace App\Database;

use App\Config\DatabaseConfig;
use App\ErrorHandling\DatabaseErrorHandlerInterface;
use PDO;
use PDOException;

class DatabaseConnection implements DatabaseConnectionInterface
{
    private PDO $connection;

    public function __construct(
        private DatabaseConfig $config,
        private DatabaseErrorHandlerInterface $errorHandler
    ) {
        $this->connect();
    }

    private function connect(): void
    {
        if (!$this->config->isValid()) {
            $this->errorHandler->handleConfigurationError('Database configuration is missing or incomplete');
        }

        try {
            $this->connection = new PDO(
                $this->config->getDsn(),
                $this->config->getUsername(),
                $this->config->getPassword(),
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => $this->config->isPersistent(),
                ]
            );
        } catch (PDOException $e) {
            $this->errorHandler->handleConnectionError($e);
        }
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }

    public function testConnection(): bool
    {
        try {
            $this->connection->query('SELECT 1');
            return true;
        } catch (PDOException $e) {
            $this->errorHandler->handleConnectionError($e);
            return false;
        }
    }
}
