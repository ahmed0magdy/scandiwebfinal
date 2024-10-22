<?php

namespace App\GraphQL\Resolvers\Products;

use App\Models\Product;

class ProductMutationResolver
{

    public function __construct(private Product $productModel)
    {

    }

    public function insertProductWithAttributes(array $product): array
    {
        try {
            $product = $this->productModel->insertProductWithAttributes($product);
            return $product;
        } catch (\Exception $e) {
            throw new \GraphQL\Error\UserError('Failed to create product: ' . $e->getMessage());
        }
    }

    public function deleteProduct(array $productIds): bool
    {
        return $this->productModel->deleteProducts($productIds);
    }
}