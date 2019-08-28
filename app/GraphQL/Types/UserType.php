<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\User;
use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'User',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'User id',
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'User name',
            ],
            'email' => [
                'type' => Type::string(),
                'description' => 'User email',
            ],
            'threads' => [
                'args' => [
                    'id' => [
                        'type' => Type::int(),
                        'description' => 'User id',
                    ],
                ],
                'type' => Type::listOf(GraphQL::type('Thread')),
                'description' => 'Users threads',
            ]
        ];
    }

    /**
     * @param User $root
     * @param $args
     * @return mixed
     */
    public function resolveThreadsField($root, $args)
    {
        if (isset($args['id'])) {
            return $root->threads()->whereUserId($args['id'])->get();
        }

        return $root->threads;
    }
}
