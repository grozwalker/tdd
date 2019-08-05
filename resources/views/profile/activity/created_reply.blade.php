@component('profile.activity.active')
    @slot('heading')
        <a href="{{ route('profile.name', $active->subject->owner->name) }}">
            {{ $active->subject->owner->name }}
        </a>
        write a reply to  <a href="{{ $active->subject->thread->path() }}">{{ $active->subject->thread->title }}</a>
    @endslot

    @slot('body')
        {{ $active->subject->body }}
    @endslot
@endcomponent