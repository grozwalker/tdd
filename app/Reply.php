<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Reply
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property int $thread_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereThreadId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Reply whereUserId($value)
 * @property-read \App\User $owner
 */
class Reply extends Model
{
    protected $guarded = [];

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorited');
    }
}
