<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function can_see_profile()
    {
        $profile = create(User::class);

        $this->get('/profile/' . $profile->name)
            ->assertSee($profile->name);
    }

    /** @test */
    public function can_see_all_user_threads()
    {
        $profile = create(User::class);

        $thread = create(Thread::class, [
            'user_id' => $profile->id,
        ]);

        $this->get('/profile/' . $profile->name)
            ->assertSee($thread->title);
    }
}
