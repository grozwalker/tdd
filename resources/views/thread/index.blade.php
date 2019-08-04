@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="mb-4 mt-2 border-bottom">Threads</h1>

                @forelse($threads as $thread)
                    <div class="card mb-4 mt-2">
                        <div class="card-header">
                            <div class="article_header">
                                <h3>
                                    <a href="{{ $thread->path() }}">
                                        {{ $thread->title }}
                                    </a>
                                </h3>
                                <div class="level"><a href="#">{{ $thread->replies_count }} replies</a></div>
                            </div>
                        </div>
                        <div class="card-body">
                                <article>

                                    <div class="body">
                                        {{ $thread->body }}
                                    </div>
                                </article>
                        </div>
                    </div>
                @empty
                    <p>There are no query results fo this channel.</p>
                @endforelse
            </div>
        </div>
    </div>
@endsection
