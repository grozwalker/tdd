@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('thread.card', ['thread' => $thread])
                    {{ $thread->body }}
                @endcomponent
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('thread.replies')
            </div>
        </div>
        <br>

        @if(auth()->check())
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        @csrf

                        <div class="form-group">
                            <textarea class="form-control" id="body" name="body" rows="5" placeholder="Type your answear"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-center">Please <a href="{{ route('login') }}">sign in</a> to participate in forum.</p>
        @endif
    </div>
@endsection
