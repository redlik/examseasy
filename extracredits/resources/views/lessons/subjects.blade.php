@extends('layouts.app')

@section('content')
<div class="col-2">
    <h2>Subjects</h2>
    <ul>
        @foreach ($subjects as $subjectsSidebar)
        <li><a href="#{{$subjectsSidebar->name}}"">{{ ucfirst($subjectsSidebar->name) }}</a></li>       
        @endforeach
    </ul>
</div>
<div class="col-10">
    @foreach ($subjects as $subject)
    <h2 id="{{ $subject->name }}">All lessons in {{ ucfirst($subject->name)}}</h2>
 

    <div class="row">
        @foreach ($subject->lesson as $lesson)
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
                        <a href="{{ url('/lesson', [$lesson->id]) }}" class="btn btn-success">View <i class="fas fa-tv ml-2"></i></a>
                    @elseif ($credits == 0)
                        <a href="{{ route('buy_credits') }}" class="btn btn-danger"><i class="fas fa-cart-plus mr-2"></i> Buy more credits</a>
                    @else
                        <a href="{{ route('is-unlocked', [$lesson->id]) }}" class="btn btn-warning"><i class="fas fa-unlock mr-2"></i> Unlock -
                        {{ $credits }}</a>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <hr>
    @endforeach
</div>
@endsection
