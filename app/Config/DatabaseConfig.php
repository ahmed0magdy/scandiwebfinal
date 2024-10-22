<?php

namespace App\Config;

use Dotenv\Dotenv;

class DatabaseConfig
{
    private array $config;

    public function __construct()
    {
        $this->loadEnvironment();
        $this->loadConfig();
    }

    private function loadEnvironment(): void
    {
        if (!isset($_ENV['DB_HOST'])) {
            $rootPath = dirname(__DIR__, 2); // Go up two levels from /config to reach the project root
            $dotenv = Dotenv::createImmutable($rootPath);
            $dotenv->load();
        }
    }

    private function loadConfig(): void
    {
        // Load the configuration from the existing file
        $this->config = require __DIR__ . '/database.php';

        // Add any additional keys that might not be in the original config
        $this->config['persistent'] = $_ENV['DB_PERSISTENT'] ?? false;
    }

    public function getDsn(): string
    {
        return "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']};charset={$this->config['charset']}";
    }

    public function getUsername(): string
    {
        return $this->config['user'];
    }

    public function getPassword(): string
    {
        return $this->config['password'];
    }

    public function isPersistent(): bool
    {
        return $this->config['persistent'];
    }

    public function isValid(): bool
    {
        return !empty($this->config['host']) &&
            !empty($this->config['dbname']) &&
            !empty($this->config['user']) &&
            !empty($this->config['password']);
    }
}
