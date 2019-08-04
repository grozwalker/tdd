<?php

namespace Tests\Unit;

use App\Activity;
use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ActivityTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function add_activity_when_thread_created()
    {
        $this->signIn();

        $thread = create(Thread::class);

        $this->assertDatabaseHas('activities', [
            'user_id' => auth()->user()->id,
            'type' => 'created_thread',
            'subject_id' => $thread->id,
            'subject_type' => Thread::class,
        ]);

        $activity = Activity::first();

        $this->assertEquals($activity->subject->id, $thread->id);
    }

    /** @test */
    public function add_activity_when_reply_created()
    {
        $this->signIn();

        $reply = create(Reply::class);

        $this->assertDatabaseHas('activities', [
            'user_id' => auth()->user()->id,
            'type' => 'created_reply',
            'subject_id' => $reply->id,
            'subject_type' => Reply::class,
        ]);

        $activity = Activity::all();

        $this->assertCount(2, $activity);
    }
}
