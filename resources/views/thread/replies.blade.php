@foreach($replies as $reply)
    <div class="card">
        <div class="card-header">
            <div class="level">
                <div class="info">
                    <a href="{{ route('profile.name', $reply->owner->name) }}">
                        {{ $reply->owner->name }}
                    </a> said {{ $reply->created_at->diffForHumans() }}
                </div>

                <form method="post" action="/replies/{{ $reply->id }}/favorites">
                    {{ csrf_field() }}
                    <button type="submit" class="btn" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ \Illuminate\Support\Str::plural('Favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            {{ $reply->body }}
        </div>
    </div>
    <br>
@endforeach

{{ $replies->links() }}