@component('profile.activity.active')
    @slot('heading')
        <a href="{{ $active->subject->favorited->path() }}">
            {{ $userProfile->name }}
        </a> add to favorite.
    @endslot

    @slot('body')
        {{ $active->subject->favorited->body }}
    @endslot
@endcomponent