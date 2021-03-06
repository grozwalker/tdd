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

        $this->post($thread->path() . '/replies', []);
    }

    /** @test */
    function an_auth_user_can_add_reply()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class);

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->assertDatabaseHas('replies', [
            'body' => $reply->body
        ]);

        $this->assertEquals(1, $thread->refresh()->replies_count);
    }

    /** @test */
    function reply_required_a_body()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $reply = make(Reply::class, ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
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

        $thread = create(Thread::class);

        $reply = create(Reply::class, [
            'user_id' => auth()->id(),
            'thread_id' => $thread->id
        ]);

        $this->delete('/replies/'. $reply->id)
            ->assertStatus(302);

        $this->assertDatabaseMissing('replies', ['id' => $reply->id]);

        $this->assertEquals(0, $thread->refresh()->replies_count);
    }

    /** @test */
    public function unauth_user_cant_update_reply()
    {
        $reply = create(Reply::class);

        $this->patch('/replies/'. $reply->id)
            ->assertRedirect('/login');

        $this->signIn()
            ->patch('/replies/'. $reply->id)
            ->assertStatus(403);
    }

    /** @test */
    public function auth_user_cant_update_reply()
    {
        $this->signIn();

        $reply = create(Reply::class, ['user_id' => auth()->id()]);

        $newBody = 'Updated';

        $this->patch('/replies/'. $reply->id, [
            'body' => $newBody,
        ]);

        $this->assertDatabaseHas('replies', [
            'id' => $reply->id,
            'body' => $newBody,
        ]);
    }
}
