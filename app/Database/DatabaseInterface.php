<?php

namespace App\Database;
interface DatabaseInterface
{
    public function query(string $sql): self;

    public function bind($param, $value, $type = null): self;

    public function execute(): bool;

    public function fetchAll(): array;

    public function delete($params): int;

    public function getLastInsertId();

    public function beginTransaction();

    public function commit();

    public function rollback();
}