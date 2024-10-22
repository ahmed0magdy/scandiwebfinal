<?php

namespace App\GraphQL;

use App\GraphQL\Resolvers\Products\ProductMutationResolver;

class MutationResolver
{


    public function __construct(private ProductMutationResolver $productsMutationResolver)
    {
    }

    public function insertProductWithAttributes($product)
    {
        return $this->productsMutationResolver->insertProductWithAttributes($product);
    }

    public function deleteProduct($productIds)
    {
        return $this->productsMutationResolver->deleteProduct($productIds);
    }
}
