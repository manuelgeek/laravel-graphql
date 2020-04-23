<?php


namespace App\GraphQL\Fields;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Field;

class ImageFields extends Field
{
    protected $attributes = [
        'description'   => 'A full image path',
    ];

    public function type(): Type
    {
        return Type::string();
    }

    public function args(): array
    {
        return [
            'avatar' => [
                'type' => Type::string(),
                'description' => 'The full path'
            ],
        ];
    }

    protected function resolve($root, $args)
    {
        $avatar = $root->{$this->attributes['name']};
       return $avatar != null ? asset($avatar) : null;
    }
}
