<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function a_guest_user_cant_add_reply()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $this->withoutExceptionHandling();

        $thread = create(Thread::class);

        $this->post('/threads/'. $thread->id . '/replies', []);
    }

    /** @test */
    function an_auth_user_can_add_reply()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class);

        $this->post('/threads/'. $thread->id . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    /** @test */
    function reply_required_a_body()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class, ['body' => null]);

        $this->post('/threads/'. $thread->id . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }

    /** @test */
    public function unauth_user_can_delete_reply()
    {
        //$this->withoutExceptionHandling();

        $reply = create(Reply::class);

        $this->delete('/replies/'. $reply->id)
            ->assertRedirect('/login');

        $this->signIn()
            ->delete('/replies/'. $reply->id)
            ->assertStatus(403);
    }

    /** @test */
    public function auth_user_can_delete_own_reply()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $this->delete('/replies/'. $reply->id)
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);
    }
}
