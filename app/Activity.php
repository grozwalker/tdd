<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $guarded = ['id'];

    public function subject()
    {
        return $this->morphTo();
    }

    public static function feed($user, $take = 50)
    {
        return static::whereUserId($user->id)
            ->with('subject')
            ->latest()
            ->take($take)
            ->get()
            ->groupBy(function ($active) {
            return $active->created_at->format('d-m-Y');
        });
    }
}
