@extends('layouts.app')

@section('show_credits')
    @auth
    <li class="mb-sm-4 mb-md-0"><strong>Credits: {{ Auth::user()->credits }} </strong></li>
    @endauth
@endsection

@section('content')
@guest
<div class="d-flex align-items-center align-content-center">
    <h2>You are not authorised to view this page.</h2>  
</div>
@endguest
@role('student')
<div class="col-12">
    <h2 class="main-heading">Your unlocked videos</h2>

    <div class="row">
        @foreach ($lessons as $lesson)
        <div class="col-md-12 col-lg-4 ">
            <div class="card mb-3">
                <img src="/images/thumbnails/{{ $lesson->thumbnail }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $lesson->title }}</h5>
                    <p class="card-text">{{ Str::words($lesson->description, 12, '  ...') }}</p>
                                <a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}" class="btn btn-success">View <i
                                        class="fas fa-tv ml-2"></i></a>
                </div>
            </div>
        </div>
        @endforeach

    </div>
    <ul>
    </ul>
</div>
@endrole
@endsection
