<?php

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;

class CategoryType extends ObjectType
{
    public function __construct()
    {
        parent::__construct([
            'name' => 'Category',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'name' => Type::nonNull(Type::string()),
                'attributes' => [
                    'type' => Type::listOf(TypeRegistry::get(AttributeType::class)),
                    'resolve' => function ($root, $args, $context) {
                        return $context['queryResolver']->getAttributesByCategoryId($root['id']);
                    }
                ],
            ]
        ]);
    }
}