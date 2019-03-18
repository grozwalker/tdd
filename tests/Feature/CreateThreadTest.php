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

        $this->post('threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
