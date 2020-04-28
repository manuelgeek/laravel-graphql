<?php

namespace App\GraphQL\Mutation;

use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;

class LogoutMutation extends Mutation
{
    protected $attributes = [
        'name' => 'logOut',
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'logout' => [
                'name' => 'logout',
                'type' => Type::nonNull(Type::boolean()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $user = Auth::user();
        if (! $user) {
            throw new \Exception('Unauthorized!');
        }
        $user->api_token = '';
        $user->remember_token = '';
        $user->save();

        return 'Logged out';
    }
}
