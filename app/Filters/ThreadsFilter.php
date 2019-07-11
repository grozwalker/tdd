<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ThreadsFilter
{
    /**
     * @var Request
     */
    private $request;
    private $builder;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        if (! $this->request->has('by')) {
            return $builder;
        }

        return $this->by($this->request->by);
    }

    protected function by($username)
    {
        $user = User::whereName($this->request->by)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }
}