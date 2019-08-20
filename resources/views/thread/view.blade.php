@extends('layouts.app')

@section('content')
    <thread-view :default-count="{{ $thread->replies_count }}"  inline-template>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    @component('thread.card', ['thread' => $thread])
                        {{ $thread->body }}
                    @endcomponent

                    <replies @added="added" @reduce="reduce()"></replies>

                    {{--@include('thread.replies')--}}
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Post info
                        </div>
                        <div class="card-body">
                            This thread was published {{ $thread->created_at->diffForHumans() }}
                            by <a href="{{ route('profile.name', $thread->creator->name) }}">{{ $thread->creator->name }}</a>, and
                            has @{{ repliesCount }}
                            {{--has {{ $thread->replies_count }} {{ \Illuminate\Support\Str::plural('comment', $thread->replies_count) }}.--}}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </thread-view>
@endsection
