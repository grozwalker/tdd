<?php

use Illuminate\Database\Seeder;

class ThreadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $threads = factory(App\Thread::class, 50)->create();

        $threads->each(function ($thread) {
            factory(App\Reply::class, mt_rand(0, 20))->create([
               'thread_id' => $thread->id,
            ]);
        });
    }
}
