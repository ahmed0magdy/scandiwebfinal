<?php

namespace App\GraphQL;

use GraphQL\Type\Schema;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\Type;
use App\GraphQL\Types\ProductType;
use App\GraphQL\Types\CategoryType;
use App\GraphQL\Types\InputTypeBuilder;
use App\GraphQL\Types\TypeRegistry;

class SchemaBuilder
{

    public function __construct(private QueryResolver $queryResolver, private MutationResolver $mutationResolver)
    {
    }

    public function build(): Schema
    {
        return new Schema([
            'query' => $this->buildQueryType(),
            'mutation' => $this->buildMutationType()
        ]);
    }

    private function buildQueryType(): ObjectType
    {

        return new ObjectType([
            'name' => 'Query',
            'fields' => [
                'products' => [
                    'type' => Type::listOf(TypeRegistry::get(ProductType::class)),
                    'resolve' => fn() => $this->queryResolver->resolveProducts(),
                ],
                'categories' => [
                    'type' => Type::listOf(TypeRegistry::get(CategoryType::class)),
                    'resolve' => fn() => $this->queryResolver->getAllCategories(),
                ]
            ]
        ]);
    }

    private function buildMutationType(): ObjectType
    {
        return new ObjectType([
            'name' => 'Mutation',
            'fields' => [
                'createProduct' => [
                    'type' => TypeRegistry::get(ProductType::class),
                    'args' => [
                        'product' => Type::nonNull(InputTypeBuilder::buildProductInputType()),
                    ],
                    'resolve' => fn($root, $args) => $this->mutationResolver->insertProductWithAttributes($args['product']),
                ],
                'deleteProduct' => [
                    'type' => Type::boolean(),
                    'args' => [
                        'id' => Type::nonNull(Type::listOf(Type::nonNull(Type::id())))
                    ],
                    'resolve' => fn($root, $args) => $this->mutationResolver->deleteProduct($args['id']),
                ]
            ]
        ]);
    }

}
