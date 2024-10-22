<?php

namespace App\ErrorHandling;

class DatabaseErrorHandlerFactory
{
    public static function create(): DatabaseErrorHandlerInterface
    {
        $env = $_ENV['APP_ENV'] ?? 'production';

        return match ($env) {
            'development' => new DevelopmentDatabaseErrorHandler(),
            default => new ProductionDatabaseErrorHandler(),
        };
    }
}
