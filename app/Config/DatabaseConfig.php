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
            $rootPath = dirname(__DIR__, 2);
            $dotenv = Dotenv::createImmutable($rootPath);
            $dotenv->load();
        }
    }

    private function loadConfig(): void
    {
        $this->config = require __DIR__ . '/database.php';
    }

    public function getDsn(): string
    {
        return "mysql:host={$this->config['host']};port={$this->config['port']};dbname={$this->config['dbname']};";
    }

    public function getBaseDsn(): string
    {
        return "mysql:host={$this->config['host']};port={$this->config['port']}";
    }

    public function getUsername(): string
    {
        return $this->config['user'];
    }

    public function getPassword(): string
    {
        return $this->config['password'];
    }

    public function getDatabaseName(): string
    {
        return $this->config['dbname'];
    }

    public function isValid(): bool
    {
        return !empty($this->config['host']) &&
            !empty($this->config['dbname']) &&
            !empty($this->config['user']) &&
            !empty($this->config['password']);
    }
}