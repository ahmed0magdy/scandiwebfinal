<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Product',
            'fields' => function () {
                return [
                    'id' => Type::nonNull(Type::id()),
                    'sku' => Type::nonNull(Type::string()),
                    'name' => Type::nonNull(Type::string()),
                    'price' => Type::nonNull(Type::float()),
                    'productAttributes' => [
                        'type' => Type::listOf(TypeRegistry::get(ProductAttributeType::class)),
                        'resolve' => function ($root, $args, $context) {
                            return $context['queryResolver']->getProductAttributes($root['id']);
                        }
                    ]
                ];
            }
        ]);
    }
}
