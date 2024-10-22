<?php

namespace App\GraphQL\Resolvers\Products;

use App\Models\Product;
use GraphQL\Deferred;

class ProductQueryResolver
{
    private Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function resolveProducts(): array
    {
        return $this->product->findAll();
    }

    public function getProductAttributes($productId): Deferred
    {
        return new Deferred(function () use ($productId): array {
            $product = clone $this->product;
            $product->setId($productId);
            return $product->getProductAttributes();
        });
    }
}