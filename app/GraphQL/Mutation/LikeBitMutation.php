<?php

namespace App\GraphQL\Mutation;

use App\Bit;
use App\Like;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;

class LikeBitMutation extends Mutation
{
    protected $attributes = [
        'name' => 'likeBit',
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'bit_id' => [
                'name' => 'bit_id',
                'type' => Type::nonNull(Type::int()),
                'rules' => ['required'],
            ],
        ];
    }

    public function authenticated($root, $args, $currentUser)
    {
        return (bool) $currentUser;
    }

    public function resolve($root, $args)
    {
        $bit = Bit::find($args['bit_id']);

        $like = new Like();
        $like->user_id = auth()->user()->id;
        $bit->likes()->save($like);

        return 'Like successful!';
    }
}
