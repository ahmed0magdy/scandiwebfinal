<?php

namespace App\Models;
use App\Models\BaseModel;

class Product extends BaseModel
{
    private int $id;
    private string $sku;
    private string $name;
    private float $price;
    private array $attributes = [];

    public function getTableName(): string
    {
        return 'Products';
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setSku(string $sku): void
    {
        $this->sku = $sku;
    }

    public function getSku(): string
    {
        return $this->sku;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getProductAttributes(): array
    {
        $query = "
SELECT pa.product_id, a.id, a.name, pa.value
FROM Product_Attribute pa
JOIN Attributes a ON a.id = pa.attribute_id
WHERE pa.product_id = :product_id
";
        $this->db->query($query)->bind(':product_id', $this->getId());
        $result = $this->db->fetchAll();

        $attributes = [];
        foreach ($result as $row) {
            $attributes[] = [
                'attribute' => ['id' => $row['id'], 'name' => $row['name']],
                'value' => $row['value']
            ];
        }

        $this->setAttributes($attributes);
        return $this->getAttributes();
    }

    public function insertProductWithAttributes(array $product): array
    {
        try {
            $this->db->beginTransaction();

            $productId = $this->create([
                'sku' => $product['sku'],
                'name' => $product['name'],
                'price' => abs($product['price'])
            ]);

            if (isset($product['attributes'])) {
                $attributeStmt = $this->db->query('INSERT INTO Product_Attribute (product_id, attribute_id, value) VALUES (:product_id, :attribute_id, :value)');
                foreach ($product['attributes'] as $attribute) {
                    $attributeStmt->bind(':product_id', $productId)
                        ->bind(':attribute_id', $attribute['id'])
                        ->bind(':value', $attribute['value'])
                        ->execute();
                }
            }

            $this->db->commit();
            return [
                'id' => $productId,
                'sku' => $product['sku'],
                'name' => $product['name'],
                'price' => abs($product['price']),
                'attributes' => $product['attributes']
            ];
        } catch (\Exception $e) {
            $this->db->rollback();
            throw new \Exception('Failed to create product: ' . $e->getMessage());
        }
    }

    public function deleteProducts(array $productIds): bool
    {
        try {
            $placeholders = implode(',', array_fill(0, count($productIds), '?'));

            return $this->db->query("DELETE FROM " . $this->getTableName() . " WHERE id IN ($placeholders)")
                ->delete($productIds);
        } catch (\Exception $e) {
            throw new \Exception('Failed to create product: ' . $e->getMessage());
        }

    }
}