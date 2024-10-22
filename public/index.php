<?php
declare(strict_types=1);
require_once __DIR__ . '/../vendor/autoload.php';

use App\Application;
use App\Database\Database;
use App\GraphQL\MutationResolver;
use App\GraphQL\QueryResolver;
use App\GraphQL\SchemaBuilder;
use App\Database\DatabaseConnection;
use App\Config\DatabaseConfig;
use App\ErrorHandling\DevelopmentDatabaseErrorHandler;
use App\GraphQL\Resolvers\Products\ProductQueryResolver;
use App\GraphQL\Resolvers\Categories\CategoryQueryResolver;
use App\GraphQL\Resolvers\Products\ProductMutationResolver;
use App\Models\Category;
use App\Models\Product;



$dbConnection = new DatabaseConnection(new DatabaseConfig(), new DevelopmentDatabaseErrorHandler());
$database = new Database($dbConnection);
$product = new Product($database);
$category = new Category($database);
$productsResolver = new ProductQueryResolver($product);
$categoryResolver = new CategoryQueryResolver($category);
$productsMutationResolver = new ProductMutationResolver($product);
$queryResolver = new QueryResolver($productsResolver, $categoryResolver);
$mutationResolver = new MutationResolver($productsMutationResolver);
$schemaBuilder = new SchemaBuilder($queryResolver, $mutationResolver);
$app = new Application($queryResolver, $mutationResolver, $schemaBuilder);
$app->run();