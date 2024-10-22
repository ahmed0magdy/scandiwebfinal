<?php

namespace App\ErrorHandling;

interface DatabaseErrorHandlerInterface
{
    public function handleConnectionError(\PDOException $e): void;
    public function handleConfigurationError(string $message): void;
}
