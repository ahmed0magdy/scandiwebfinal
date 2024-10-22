<?php

namespace App\Database;

class Database implements DatabaseInterface
{
    private \PDO $connection;
    private ?\PDOStatement $statement = null;

    public function __construct(DatabaseConnectionInterface $databaseConnection)
    {
        $this->connection = $databaseConnection->getConnection();
    }

    public function query(string $sql): self
    {
        $this->statement = $this->connection->prepare($sql);
        return $this;
    }

    public function bind($param, $value, $type = null): self
    {
        if (is_null($type)) {
            $type = match (true) {
                is_int($value) => \PDO::PARAM_INT,
                is_bool($value) => \PDO::PARAM_BOOL,
                is_null($value) => \PDO::PARAM_NULL,
                default => \PDO::PARAM_STR
            };
        }

        $this->statement->bindValue($param, $value, $type);
        return $this;
    }

    public function execute(): bool
    {
        return $this->statement->execute();
    }

    public function fetchAll(): array
    {
        $this->execute();
        return $this->statement->fetchAll();
    }

    public function delete($params): int
    {
        $this->statement->execute($params);
        return $this->statement->rowCount();
    }

    public function getLastInsertId()
    {
        return $this->connection->lastInsertId();
    }

    public function beginTransaction()
    {
        return $this->connection->beginTransaction();
    }

    public function commit()
    {
        return $this->connection->commit();
    }

    public function rollback()
    {
        return $this->connection->rollBack();
    }
}
