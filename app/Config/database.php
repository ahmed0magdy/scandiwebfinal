<?php

return [
    'host' => $_ENV['DB_HOST'] ?? 'database',
    'port' => $_ENV['DB_PORT'] ?? '3306',
    'dbname' => $_ENV['DB_NAME'] ?? 'scandi_db',
    'user' => $_ENV['DB_USERNAME'] ?? 'scandi_user',
    'password' => $_ENV['DB_PASSWORD'] ?? ''
];
