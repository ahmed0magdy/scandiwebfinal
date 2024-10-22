<?php

namespace App\GraphQL\Resolvers\Categories;

use App\Models\Category;
use GraphQL\Deferred;

class CategoryQueryResolver
{
    private Category $categoryModel;

    public function __construct(Category $categoryModel)
    {
        $this->categoryModel = $categoryModel;
    }

    public function getAllCategories(): array
    {
        return $this->categoryModel->findAll();
    }

    public function getAttributesByCategoryId($categoryId): Deferred
    {
        return new Deferred(function () use ($categoryId): array {
            $category = clone $this->categoryModel;
            $category->setId($categoryId);
            return $category->getAttributesByCategoryId();
        });
    }
}
