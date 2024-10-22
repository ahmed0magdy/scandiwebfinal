<?php

namespace App\Models;
use App\Models\BaseModel;

class Category extends BaseModel
{
    private int $id;
    private string $name;

    public function getTableName(): string
    {
        return 'Categories';
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAttributesByCategoryId(): array
    {
        $query = "SELECT a.id, a.name FROM Attributes a WHERE category_id = :category_id";
        $this->db->query($query)->bind(':category_id', $this->getId());
        return $this->db->fetchAll();
    }
}