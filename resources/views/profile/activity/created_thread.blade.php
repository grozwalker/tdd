@component('profile.activity.active')
    @slot('heading')
        <a href="{{ route('profile.name', $active->subject->creator->name) }}">
            {{ $active->subject->creator->name }}
        </a>
        write thread <a href="{{ $active->subject->path() }}">{{ $active->subject->title }}</a>
    @endslot

    @slot('body')
        {{ $active->subject->body }}
    @endslot
@endcomponent