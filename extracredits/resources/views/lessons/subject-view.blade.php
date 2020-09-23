@extends('layouts.app')

@section('show_credits')
    @auth
        @role('student')
        <li class="mb-sm-4 mb-md-0 display-6"><strong>Credits: {{ Auth::user()->credits }}</strong></li>
        @endrole
    @endauth
@endsection

@section('content')
<div class="col-12 col-md-3 bg-white rounded-lg shadow p-3 sticky-top" style="height:90%">
    <h5 class="text-uppercase font-weight-black">In this section</h5>
    <ul class="list-unstyled sidebar-menu">
    @foreach ($subcategories as $subcategory)
    
    <li>
        <a href="#{{ $subcategory->slug }}" class="unlink"><span class="links-text">{{ $subcategory->name }}</span></a>
        @if ($subcategory->topic->count()>0)
        <span class="open-menu collapsed" data-toggle="collapse" data-target="#collapse-{{ $subcategory->slug }}" role="heading" aria-expanded="false"><i class="fa fa-plus-circle"></i></span>
        @endif
        
    
        <div class="collapse" id="collapse-{{ $subcategory->slug }}" aria-expanded="false" style="height: 0px;">
            <ul>
                @foreach ($topics as $topic)
                    @if ($topic->subcategory_id == $subcategory->id)
                        <li><a href="#{{ $topic->slug }}" class="unlink">{{ $topic->name }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
    </li>
    @endforeach
    </ul>
</div>

<div class="col-12 col-md-9">
    <div class="container">
        <div class="row">
            @if ($subject ?? '')
            <h2 class="main-heading display-4">All lessons in {{ ucfirst($subject->name) }}</h2>
            <hr class="green-dots mb-4 w-100">
            @else
            <h2>All lessons index</h2>
            @endif
        </div>
        
    
        <div class="row">
            <ul class="list-unstyled">
                @foreach ($subcategories as $main_subcategory)
                <div class="row">
                    <div class="col-12">
                    <a href="{{ route('subject.category', [$subject->name, $main_subcategory->slug]) }}"><h3 id="{{ $main_subcategory->slug }}"class="text-secondary font-weight-bold my-3 text-uppercase">{{ $main_subcategory->name }}</h3></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        @foreach ($topics as $main_topic)
                        @if ($main_topic->subcategory_id == $main_subcategory->id)
                    <a href="{{  route('subject.topic', [$subject->name, $main_subcategory->slug, $main_topic->slug])}}" class="unlink"><h5 id="{{ $main_topic->slug }}" class="font-weight-bold text-uppercase">{{ $main_topic->name }}</h5></a>
                                @foreach ($lessons as $lesson)
                                    @if ($lesson->topic_id == $main_topic->id)
                                    <div class="col-12 col-md-4 col-lg-4 ">
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
                                    @endif
                                @endforeach
                        @endif
                        @endforeach
                    </div>
                </div>
                   
                @endforeach
            </ul>
            
    
        </div>
    </div>
    
</div>
@endsection
