<?php

namespace Tests\Feature;

use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadSubscriptionTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function a_user_can_subscribe()
    {
        //$this->withoutExceptionHandling();

        $this->signIn();

        $thread = create(Thread::class);

        $this->post($thread->path() . '/subscriptions');

        $thread->addReply([
            'user_id' => auth()->id(),
            'body' => 'test',
        ]);

        $this->assertCount(1, $thread->subscriptions);
    }
}
