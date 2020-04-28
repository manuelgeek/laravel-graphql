<?php

namespace App\GraphQL\Queries;

use App\Bit;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class AllBitsQuery extends Query
{
    protected $attributes = [
        'name' => 'allBits',
    ];

    public function type(): Type
    {
        return Type::listOf(GraphQL::type('Bit'));
    }

    public function resolve($root, $args, $context, ResolveInfo $info)
    {
        $fields = $info->getFieldSelection();

        $bits = Bit::query();

        foreach ($fields as $field => $keys) {
            if ($field === 'user') {
                $bits->with('user');
            }

            if ($field === 'replies') {
                $bits->with('replies');
            }

            if ($field === 'likes_count') {
                $bits->with('likes');
            }
        }

        return $bits->latest()->get();
    }
}
