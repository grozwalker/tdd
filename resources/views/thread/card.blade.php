<div class="card mb-5">
    <div class="card-header">
        <div class="level">
            <div class="info">
                <a href="{{ route('profile.name', $thread->creator->name) }}">
                    {{ $thread->creator->name }}
                </a>
                write {{ $thread->title }}
            </div>

            @can('update', $thread)
                <form method="post" action="{{ $thread->path() }}">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn">
                        Delete thread
                    </button>
                </form>
            @endcan
        </div>
    </div>
    <div class="card-body">
        {{ $slot }}
    </div>
</div>