<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Filters\ThreadsFilter;
use App\Thread;
use App\User;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Channel $channel, ThreadsFilter $filter)
    {
        $threads = Thread::latest()->filter($filter);

        if ($channel->exists) {
            $threads->where('channel_id', $channel->id);
        }

        $threads = $threads->get();

        if (request()->expectsJson()) {
            return  response()->json($threads);
        }

        return view('thread.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('thread.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'title' => 'required|min:5',
           'body' => 'required',
           'channel_id' => [
               'required',
               'exists:channels,id'
           ],
        ]);

        $thread = Thread::create([
           'user_id' => auth()->id(),
           'channel_id' => $request->channel_id,
           'title' => $request->title,
           'body' => $request->body
        ]);

        return redirect($thread->path())
            ->with('flash', 'Thread successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param $channel_id
     * @param  \App\Thread $thread
     * @return \Illuminate\Http\Response
     */
    public function show($channel_id, Thread $thread)
    {
        return view('thread.view', [
            'thread' => $thread,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Thread  $thread
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $channel
     * @param \App\Thread $thread
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy($channel, Thread $thread)
    {
        $this->authorize('update', $thread);

        $thread->delete();

        if (request()->expectsJson()) {
            return response([], 204);
        }

        return redirect('/threads')->with('flash', 'Thread successfully deleted');
    }
}
