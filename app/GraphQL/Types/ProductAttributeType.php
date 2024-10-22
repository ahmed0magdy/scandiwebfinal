<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class ProductAttributeType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'ProductAttribute',
            'fields' => [
                'attribute' => TypeRegistry::get(AttributeType::class),
                'value' => Type::nonNull(Type::string()),
            ]
        ]);
    }
}
