<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CreateThreadTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */

    function guest_cant_create_thread()
    {
        $this->get('/threads/create')
            ->assertRedirect('/login');

        $this->post('threads', [])
            ->assertRedirect('/login');
    }

    /** @test */

    function an_auth_user_can_create_thread()
    {
        $this->signIn();

        $thread = make(Thread::class);

        $response = $this->post('/threads', $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */

    function a_thread_require_title()
    {
        $this->publishThread(['title' => null])
            ->assertSessionHasErrors('title');
    }

    /** @test */

    function a_thread_require_body()
    {
        $this->publishThread(['body' => null])
            ->assertSessionHasErrors('body');
    }

    /** @test */

    function a_thread_require_a_valid_channel()
    {
        factory(Thread::class, 4)->create();

        $this->publishThread(['channel_id' => null])
            ->assertSessionHasErrors('channel_id');

        $this->publishThread(['channel_id' => 99])
            ->assertSessionHasErrors('channel_id');
    }

    function publishThread($override = [])
    {
        $this->withoutExceptionHandling()->signIn();

        $thread = make(Thread::class, $override);

        return $this->withExceptionHandling()->post('/threads', $thread->toArray());
    }


}
