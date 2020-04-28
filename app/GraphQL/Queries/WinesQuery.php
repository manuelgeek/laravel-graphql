<?php

namespace App\GraphQL\Queries;

use App\Wine;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class WinesQuery extends Query
{
    protected $attributes = [
        'name' => 'wines',
    ];

    public function type(): Type
    {
//        return Type::listOf(GraphQL::type('Wine'));
        return GraphQL::paginate('Wine');
    }

    public function args(): array
    {
        return [
            'limit' => [
                'name' => 'limit',
                'type' => Type::int(),
                'rules' => ['required'],
            ],
            'page' => [
                'name' => 'page',
                'type' => Type::int(),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $info, Closure $getSelectFields)
    {
        $fields = $getSelectFields();

        return Wine::select($fields->getSelect())
        ->paginate($args['limit'], ['*'], 'page', $args['page']);
    }
}
