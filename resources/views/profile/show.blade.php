@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row col-md-10 offset-1">
            <div class="pb-2 mb-4 border-bottom">
                <h1>{{ $userProfile->name }}</h1>
            </div>

            @foreach($threads as $thread)
                @component('thread.card', ['thread' => $thread])
                    {{ $thread->body }}
                @endcomponent
            @endforeach
        </div>
    </div>
@endsection
