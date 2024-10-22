<?php

namespace App;

use GraphQL\GraphQL;
use GraphQL\Error\DebugFlag;
use App\GraphQL\SchemaBuilder;
use App\GraphQL\QueryResolver;
use App\GraphQL\MutationResolver;

class Application
{

    public function __construct(private QueryResolver $queryResolver, private MutationResolver $mutationResolver, private SchemaBuilder $schemaBuilder)
    {

    }

    public function run()
    {
        $schema = $this->schemaBuilder->build();

        $rawInput = file_get_contents('php://input');
        $input = json_decode($rawInput, true);
        $query = $input['query'] ?? '';
        $variables = $input['variables'] ?? null;

        try {
            $result = GraphQL::executeQuery($schema, $query, null, [
                'queryResolver' => $this->queryResolver,
                'mutationResolver' => $this->mutationResolver
            ], $variables);
            $output = $result->toArray(DebugFlag::INCLUDE_DEBUG_MESSAGE | DebugFlag::INCLUDE_TRACE);
        } catch (\Exception $e) {
            $output = [
                'errors' => [
                    [
                        'message' => $e->getMessage(),
                        'locations' => $e->getTrace()
                    ]
                ]
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($output);
    }
}
