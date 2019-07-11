<?php

namespace App\Filters;

use App\User;

class ThreadsFilter extends Filters
{
    protected $filters = ['by'];

    protected function by($username)
    {
        $user = User::whereName($username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}