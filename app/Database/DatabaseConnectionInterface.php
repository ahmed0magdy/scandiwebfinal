<?php

namespace App\Database;

interface DatabaseConnectionInterface
{
    public function getConnection(): \PDO;
}
