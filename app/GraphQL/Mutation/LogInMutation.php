<?php


namespace App\GraphQL\Mutation;


use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;

class LogInMutation extends Mutation
{
    protected $attributes = [
        'name' => 'logIn'
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'email' => [
                'name' => 'email',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required', 'email'],
            ],
            'password' => [
                'name' => 'password',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function resolve($root, $args)
    {
        $credentials = [
            'email' => $args['email'],
            'password' => $args['password']
        ];

        if($auth = Auth::attempt($credentials)){
            Auth::user()->generateToken();
            return Auth::user()->api_token;
        }

        if (!$auth) {
            throw new \Exception('Unauthorized!');
        }

    }
}
