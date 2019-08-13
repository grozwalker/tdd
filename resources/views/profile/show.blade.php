@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-md-8">
                <h1 class="page-item mb-2 pb-2">{{ $userProfile->name }}</h1>

                @forelse($activities as $date => $active)
                    <h4 class="border-bottom mt-2 pt-2">{{ $date }}</h4>
                    @foreach($active as $record)
                        @include("profile.activity.{$record->type}", [
                            'active' => $record
                        ])
                    @endforeach
                @empty
                    <p>There are no activity yet</p>
                @endforelse

            </div>
        </div>
    </div>
@endsection
