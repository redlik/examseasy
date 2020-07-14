@extends('layouts.app')

@section('content')
<div class="col">
    <h2>List of lessons go here</h2>
    <div class="row">
        @foreach ($lessons as $lesson)
        <div class="col-4">
            <div class="card">
                <img src="/images/thumbnails/{{ $lesson->thumbnail }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $lesson->title }}</h5>
                    <p class="card-text">{{ Str::words($lesson->description, 12, '  ...') }}</p>
                    @guest
                        <a href="#" class="btn btn-warning">Login</a>
                    @endguest
                    @auth
                        <a href="{{ route('is-unlocked', [$lesson->id]) }}" class="btn btn-success">View</a>
                    @endauth
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <ul>
    </ul>
</div>
@endsection
