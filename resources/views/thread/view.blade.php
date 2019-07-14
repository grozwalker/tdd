@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @component('thread.card', ['thread' => $thread])
                    {{ $thread->body }}
                @endcomponent

                @include('thread.replies')

                @if(auth()->check())
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        @csrf

                        <div class="form-group">
                            <textarea class="form-control" id="body" name="body" rows="5" placeholder="Type your answear"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in forum.</p>
                @endif
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Post info
                    </div>
                    <div class="card-body">
                        This thread was published {{ $thread->created_at->diffForHumans() }}
                        by <a href="#">{{ $thread->creator->name }}</a>, and
                        has {{ $thread->replies_count }} {{ \Illuminate\Support\Str::plural('comment', $thread->replies_count) }}.
                    </div>
                </div>
            </div>


        </div>

    </div>
@endsection
