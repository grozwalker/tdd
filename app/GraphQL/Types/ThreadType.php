<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class ThreadType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Thread',
        'description' => 'A type'
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Thread id',
            ],

            'user_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Thread user id',
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Thread title',
            ],
            'body' => [
                'type' => Type::string(),
                'description' => 'ThreadText',
            ],
        ];
    }
}
