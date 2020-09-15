@extends('layouts.app')

@section('show_credits')
    @auth
        @role('student')
        <li class="mb-sm-4 mb-md-0"><strong>Credits: {{ $credits }}</strong></li>
        @endrole
    @endauth
@endsection

@section('content')
<div class="col-12 col-md-3 bg-white rounded-lg shadow p-3 sticky-top" style="height:90%">
    <h5 class="text-uppercase font-weight-black">In this section</h5>
    <ul class="list-unstyled sidebar-menu">
    @foreach ($lessons as $lesson)
        <li><a href="#{{ $lesson->slug }}" class="unlink">{{ $lesson->title }}</a></li>
    @endforeach
    </ul>
</div>

<div class="col-12 col-md-9">
    <div class="container">
        <div class="row">
            <h2 class="main-heading">{{ $topic->name }}</h2>
            <hr class="green-dots mb-4 w-100">
        </div>
        <div class="row">
            <div class="col-12">
                @foreach ($lessons as $main_lesson)
                            <div class="col-md-12 col-lg-4 ">
                                <div class="card mb-3">
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
        </div>
            
    
    </div>
    
</div>
@endsection
