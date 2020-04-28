<?php

namespace App\GraphQL\Queries;

use App\Wine;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Query;

class WineQuery extends Query
{
    protected $attributes = [
        'name' => 'wine',
    ];

    public function type(): Type
    {
        return GraphQL::type('Wine');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::int(),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return Wine::findOrFail($args['id']);
    }
}
