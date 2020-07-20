@extends('layouts.app')

@section('content')
<div class="col">
    @if ($subject ?? '')
    <h2>All lessons in {{ ucfirst($subject)}}</h2>
    @else
    <h2>All lessons index</h2>
    @endif

    <div class="row">
        @foreach ($lessons as $lesson)
        <div class="col-4">
            <div class="card">
                <img src="/images/thumbnails/{{ $lesson->thumbnail }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $lesson->title }}</h5>
                    <p class="card-text">{{ Str::words($lesson->description, 12, '  ...') }}</p>
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-warning">Login</a>
                    @endguest
                    @auth
                    @if (user_unlocked($lesson->id) )
                    <a href="{{ url('/lesson', [$lesson->id]) }}" class="btn btn-success">View</a>
                    @else
                    <a href="{{ route('is-unlocked', [$lesson->id]) }}" class="btn btn-danger">Unlock -
                        {{ $credits }}</a>
                    @endif
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
