<?php

namespace App\ErrorHandling;

class DevelopmentDatabaseErrorHandler implements DatabaseErrorHandlerInterface
{
    public function handleConnectionError(\PDOException $e): void
    {
        $this->displayError(500, 'Database connection failed: ' . $e->getMessage());
    }

    public function handleConfigurationError(string $message): void
    {
        $this->displayError(500, 'Database configuration error: ' . $message);
    }

    private function displayError(int $statusCode, string $message): void
    {
        http_response_code($statusCode);
        exit;
    }
}
