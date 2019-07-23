<?php

namespace Tests\Feature;

use App\Favorite;
use App\Reply;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function guest_cant_add_to_favorite()
    {
        $reply = create(Reply::class);

        $this->withExceptionHandling()
            ->post('replies/' . $reply->id . '/favorites')
            ->assertRedirect('login');
    }

    /** @test */
    public function auth_user_can_add_to_favorite()
    {
        $this->withoutExceptionHandling();

        $this->signIn(create(User::class));
        $reply = create(Reply::class);

        $this->post('replies/' . $reply->id . '/favorites');

        $this->assertCount(1, $reply->favorites);
    }

    /** @test */
    public function user_cant_add_to_favorite_twice()
    {
        $this->withoutExceptionHandling();

        $this->signIn(create(User::class));
        $reply = create(Reply::class);

        try {
            $this->post('replies/' . $reply->id . '/favorites');
            $this->post('replies/' . $reply->id . '/favorites');
        } catch (\Exception $exception) {
            $this->fail('Cannot add several favorites');
        }

        $this->assertCount(1, $reply->favorites);
    }
}
