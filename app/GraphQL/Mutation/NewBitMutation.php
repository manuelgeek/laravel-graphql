<?php

namespace App\GraphQL\Mutation;

use App\Bit;
use Closure;
use GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Mutation;

class NewBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'newBit',
    ];

    public function type(): Type
    {
        return GraphQL::type('Bit');
    }

    public function args(): array
    {
        return [
            'snippet' => [
                'name' => 'snippet',
                'type' => Type::nonNull(Type::string()),
                'rules' => ['required'],
            ],
        ];
    }

    public function authorize($root, array $args, $ctx, ResolveInfo $resolveInfo = null, Closure $getSelectFields = null): bool
    {
        // true, if logged in
        return ! Auth::guest();
    }

    public function getAuthorizationMessage(): string
    {
        return 'You are not authorized to perform this action';
    }

    public function resolve($root, $args)
    {
        $bit = new Bit();

        $bit->user_id = auth()->user()->id;
        $bit->snippet = $args['snippet'];
        $bit->save();

        return $bit;
    }
}
