<?php

namespace App\ErrorHandling;

class ProductionDatabaseErrorHandler implements DatabaseErrorHandlerInterface
{
    public function handleConnectionError(\PDOException $e): void
    {
        $this->logError('Database connection failed: ' . $e->getMessage());
        $this->displayGenericError();
    }

    public function handleConfigurationError(string $message): void
    {
        $this->logError('Database configuration error: ' . $message);
        $this->displayGenericError();
    }

    private function logError(string $message): void
    {
        error_log($message);
    }

    private function displayGenericError(): void
    {
        http_response_code(500);
        exit;
    }
}
