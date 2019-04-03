@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Threads</div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="/threads">
                            @csrf
                            <div class="form-group">
                                <label for="title">Channel</label>
                                <select id="channel_id" name="channel_id" class="form-control {{ $errors->has('channel_id') ? 'is-invalid' : '' }}">
                                    @foreach($channels as $channel)
                                        <option value="{{$channel->id}}" {{ $channel->id == old('channel_id') ? 'selected' : '' }}>{{ $channel->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="title" class="form-control-label">Title</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}">
                            </div>
                            <div class="form-group">
                                <label for="body">Body</label>
                                <textarea id="body" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="8">
                                    {{ trim(old('body'))}}
                                </textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
