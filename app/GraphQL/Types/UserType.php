<?php

namespace App\GraphQL\Types;

use App\GraphQL\Fields\ImageFields;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A user',
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of a user',
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of a user',
            ],
            'email' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The email address of a user',
            ],
            'avatar' => ImageFields::class,
            'bits' => [
                'type' => Type::listOf(GraphQL::type('Bit')),
                'description' => 'The user bits',
            ],
            'api_token' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The user api token',
            ],
            'created_at' => [
                'type' => Type::string(),
                'description' => 'Date a was created',
            ],
            'updated_at' => [
                'type' => Type::string(),
                'description' => 'Date a was updated',
            ],
        ];
    }

    protected function resolveCreatedAtField($root, $args)
    {
        return (string) $root->created_at;
    }

    protected function resolveUpdatedAtField($root, $args)
    {
        return (string) $root->updated_at;
    }
}
