<?php

namespace Tests\Feature;

use App\Reply;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function auth_user_can_add_to_favorite()
    {
        $reply = create(Reply::class);

        $response = $this->post('/replies/' . $reply->id . '/favorites');

        dd($response);

        $this->assertCount(1, $reply->favorites);
    }
}
