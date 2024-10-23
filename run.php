<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config\DatabaseConfig;

try {
    // Create a DatabaseConfig instance
    $dbConfig = new DatabaseConfig();

    // Validate that the configuration is properly loaded
    if (!$dbConfig->isValid()) {
        throw new Exception('Invalid database configuration');
    }

    // Get the DSN, username, and password from the DatabaseConfig class
    $dsn = $dbConfig->getDsn();
    $username = $dbConfig->getUsername();
    $password = $dbConfig->getPassword();
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    // Create a PDO instance
    $pdo = new PDO($dsn, $username, $password, $options);

    echo "Connected successfully. Running schema script...\n";

    $pdo->exec("DROP DATABASE IF EXISTS {$_ENV['DB_NAME']}");
    $pdo->exec("CREATE DATABASE IF NOT EXISTS {$_ENV['DB_NAME']}");
    $pdo->exec("USE {$_ENV['DB_NAME']}");

    // Read the SQL file
    $sql = file_get_contents('schema.sql');

    // Execute the SQL script
    $pdo->exec($sql);

    echo "Schema script executed successfully.\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
