<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\InputObjectType;

class InputTypeBuilder
{
    public static function buildProductInputType(): InputObjectType
    {
        return new InputObjectType([
            'name' => 'ProductInput',
            'fields' => [
                'id' => Type::id(),
                'sku' => Type::nonNull(Type::string()),
                'name' => Type::nonNull(Type::string()),
                'price' => Type::nonNull(Type::float()),
                'attributes' => Type::nonNull(Type::listOf(self::buildAttributeInputType())),
            ],
        ]);
    }

    private static function buildAttributeInputType(): InputObjectType
    {
        return new InputObjectType([
            'name' => 'AttributeInput',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'value' => Type::nonNull(Type::string()),
            ],
        ]);
    }
}