@extends('layouts.app')

@section('show_credits')
    @auth
    <li class="mb-sm-4 mb-md-0"><strong>Credits: {{ $credits }}</strong></li>
    @endauth
@endsection

@section('content')
<div class="col">
    @role('student')
        <p>Hi, {{ Auth::user()->name }}</p>
    @else
        <p>You're not student</p>
    @endrole
    @if ($subject ?? '')
    <h2>All lessons in {{ ucfirst($subject)}}</h2>
    @else
    <h2>All lessons index</h2>
    @endif

    <div class="row">
        @foreach ($lessons as $lesson)
        <div class="col-md-12 col-lg-4 ">
            <div class="card">
                <img src="/images/thumbnails/{{ $lesson->thumbnail }}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{ $lesson->title }}</h5>
                    <p class="card-text">{{ Str::words($lesson->description, 12, '  ...') }}</p>
                    @role('student')
                        @if ($credits < $lesson->credit_cost)
                            <p><small class="text-danger mb-3">You don't have enough credits to unlock this lesson</small></p>
                        @endif
                    @endrole

                    @guest
                        <a href="{{ route('login') }}" class="btn btn-warning">Login to view</a>
                    @endguest

                    @auth
                        @role('teacher|superadmin')
                        <a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}" class="btn btn-success">View <i
                            class="fas fa-tv ml-2"></i></a>
                        @else
                            @if (user_unlocked($lesson->id) )
                                <a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}" class="btn btn-success">View <i
                                        class="fas fa-tv ml-2"></i></a>
                            @elseif ($credits == 0)
                                <a href="{{ route('buy_credits') }}" class="btn btn-danger"><i class="fas fa-cart-plus mr-2"></i>
                                    Buy more credits</a>
                            @else
                                <a href="{{ route('is-unlocked', [$lesson->id]) }}" class="btn btn-warning"><i
                                        class="fas fa-unlock mr-2"></i> Unlock for {{ $lesson->credit_cost }} 
                                        @if ($lesson->credit_cost == 1)
                                            credit
                                        @else
                                            credits
                                        @endif
                                        </a>
                            @endif
                        @endrole
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
