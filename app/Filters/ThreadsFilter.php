<?php

namespace App\Filters;

use App\User;

class ThreadsFilter extends Filters
{
    protected $filters = ['by', 'popular', 'unanswered'];

    protected function by($username)
    {
        $user = User::whereName($username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    protected function popular()
    {
        $this->builder->getQuery()->orders = [];
        return $this->builder->orderBy('replies_count', 'DESC');
    }

    protected function unanswered()
    {
        return $this->builder->where('replies_count', 0);
    }
}