<?php

namespace App\GraphQL;

use App\GraphQL\Resolvers\Products\ProductQueryResolver;
use App\GraphQL\Resolvers\Categories\CategoryQueryResolver;


class QueryResolver
{

    public function __construct(private ProductQueryResolver $productsResolver, private CategoryQueryResolver $categoryResolver)
    {

    }

    // Delegate calls to the appropriate resolver
    public function resolveProducts()
    {
        return $this->productsResolver->resolveProducts();
    }

    public function getProductAttributes($productId)
    {
        return $this->productsResolver->getProductAttributes($productId);
    }

    public function getAllCategories()
    {
        return $this->categoryResolver->getAllCategories();
    }
    public function getAttributesByCategoryId($categoryId)
    {
        return $this->categoryResolver->getAttributesByCategoryId($categoryId);
    }
}
