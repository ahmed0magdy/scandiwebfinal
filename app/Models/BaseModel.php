<?php

namespace App\Models;

use App\Database\DatabaseInterface;

abstract class BaseModel
{
    protected DatabaseInterface $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    abstract public function getTableName(): string;

    public function findAll(): array
    {
        $query = "SELECT * FROM " . $this->getTableName();
        return $this->db->query($query)->fetchAll();
    }

    public function create(array $data): int
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO " . $this->getTableName() . " ($columns) VALUES ($placeholders)";

        $this->db->query($query);
        foreach ($data as $key => $value) {
            $this->db->bind(":$key", $value);
        }

        $this->db->execute();
        return $this->db->getLastInsertId();
    }
}