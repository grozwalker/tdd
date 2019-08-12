@foreach($replies as $reply)
<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card">
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
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>
                <button type="submit" class="btn btn-sm btn-link mr-4" @click="editing = false">Close</button>
                <button type="submit" class="btn btn-sm btn-success" @click="update()">Save</button>
            </div>
            <div v-else v-text="body">
            </div>
        </div>

        @can ('update', $reply)
            <div class="card-footer level">
                <button type="submit" class="btn btn-sm btn-secondary" @click="editing = true">Edit</button>
                <button type="submit" class="btn btn-sm btn-danger" @click="destroy()">Delete</button>

            </div>
        @endcan
    </div>
</reply>
<br>
@endforeach

{{ $replies->links() }}