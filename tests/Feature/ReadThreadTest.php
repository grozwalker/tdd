<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    protected function setUp(): void
    {
        parent::setUp(); // TODO: Change the autogenerated stub

        $this->thread = factory(Thread::class)->create();
    }

    /** @test **/
    public function user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);
    }

    /** @test */
    public function user_can_view_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title)
            ->assertSee($this->thread->body);
    }

    /** @test */

    function user_can_view_replies_associating_with_thread()
    {
        $reply = create(Reply::class, [
            'thread_id' => $this->thread->id,
        ]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    /** @test */

    function user_can_filter_threads_associated_with_channel()
    {
        $channel = create(Channel::class);

        $threadInChannel = create(Thread::class, ['channel_id' => $channel->id]);
        $threadsNotInChannel = create(Thread::class);

        $this->get('/threads/' . $channel->slug)
            ->assertSee($threadInChannel->title)
            ->assertDontSee($threadsNotInChannel->title);
    }

}
