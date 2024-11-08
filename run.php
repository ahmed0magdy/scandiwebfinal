<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Config\DatabaseConfig;

try {

    $dbConfig = new DatabaseConfig();


    if (!$dbConfig->isValid()) {
        throw new Exception('Invalid database configuration');
    }

    $baseDsn = $dbConfig->getBaseDsn();
    $username = $dbConfig->getUsername();
    $password = $dbConfig->getPassword();
    $dbName = $dbConfig->getDatabaseName();

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    $pdo = new PDO($baseDsn, $username, $password, $options);

    echo "Connected successfully. Creating database...\n";

    $pdo->exec("DROP DATABASE IF EXISTS `$dbName`");
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbName`");
    $pdo->exec("USE `$dbName`");

    echo "Database created/selected successfully. Running schema script...\n";

    $sql = file_get_contents('schema.sql');
    $pdo->exec($sql);

    echo "Schema script executed successfully.\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}