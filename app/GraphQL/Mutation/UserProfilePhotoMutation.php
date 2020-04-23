<?php


namespace App\GraphQL\Mutation;


use App\Helpers\FileUploads;
use Closure;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Illuminate\Support\Facades\Auth;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UserProfilePhotoMutation extends Mutation
{
    protected $attributes = [
        'name' => 'UpdateUserProfilePhoto'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
    }

    public function args(): array
    {
        return [
            'profilePicture' => [
                'name' => 'profilePicture',
                'type' => GraphQL::type('Upload'),
                'rules' => ['required', 'image', 'max:1500'],
            ],
        ];
    }

    public function resolve($root, $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $file = $args['profilePicture'];

        $folder = '/upload/avatar/';
        $user = Auth::user();
        $user->avatar =  (new FileUploads())->updateImage($file, $user->avatar, $folder);
        $user->save();
        return Auth::user();
    }
}
