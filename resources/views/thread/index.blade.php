@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Threads</div>

                    <div class="card-body">
                        @foreach($threads as $thread)
                            <artice>
                                <div class="article_header">
                                    <h3>
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>
                                    </h3>
                                    <div class="level"><a href="#">{{ $thread->replies_count }}</a></div>
                                </div>
                                <div class="body">
                                    {{ $thread->body }}
                                </div>
                            </artice>
                            <hr>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
