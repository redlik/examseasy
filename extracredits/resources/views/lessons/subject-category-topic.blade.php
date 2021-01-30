@extends('layouts.app')

@section('show_credits')
    <x-creditbox/>
@endsection

@section('content')

    <div class="col-12 bg-white rounded shadow-sm p-2 pb-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center mb-4">
                    <h1 class="text-uppercase font-weight-black">{{ ucfirst($topic->name) }}</h1>
                    <p>Go back to
                        <a href="{{ route('subjects-view', [$subject->name]) }}">{{ ucfirst($subject->full_name) }}</a>
                    </p>
                </div>
            </div>
            <div class="row">
                @foreach ($lessons as $lesson)
                    <div class="col-12 col-lg-9 mx-auto mb-4 bg-white rounded shadow p-0">
                        <div class="container p-0">
                            <div class="row">
                                <div class="col-12 col-md-4 rounded">
                                    <img src="/images/thumbnails/{{ $lesson->thumbnail }}" class="img-fluid rounded" alt="{{ $lesson->title }}">
                                </div>
                                <div class="col-12 col-md-8 d-flex py-1 p-md-1 p-sm-3 align-items-start flex-column">
                                    <div class="mb-auto p-sm-2">
                                        <h5 class="display-6 font-weight-bold">{{ $lesson->title }}</h5>
                                        <p class="card-text">{{ Str::words($lesson->description, 20, '  ...') }}<br/>

                                            <span class="font-weight-bold">Credit cost: {{ $lesson->credit_cost }}</span>
                                        </p>
                                    </div>
                                    <div class="p-sm-2">
                                        @role('student')
                                        @if ( Auth::user()->credits < $lesson->credit_cost and !user_unlocked
                                        ($lesson->id))
                                            <p>
                                                <small class="text-danger mb-3">You don't have enough credits to unlock this lesson</small>
                                            </p>
                                        @endif
                                        @endrole

                                        @guest
                                            <a href="{{ route('login') }}" class="btn btn-warning">Login/Register to view</a>
                                        @endguest


                                        @auth
                                            @role('teacher|superadmin')
                                            <a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}" class="btn btn-success">View
                                                <i
                                                    class="fas fa-tv ml-2"></i></a>
                                        @else
                                            @if (Auth::user()->unlimited == 1)
                                                <a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}" class="btn btn-success">View
                                                    <i
                                                        class="fas fa-tv ml-2"></i></a>
                                            @else
                                                @if (user_unlocked($lesson->id) )
                                                    <a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}" class="btn btn-success">View
                                                        <i
                                                            class="fas fa-tv ml-2"></i></a>
                                                @elseif ( Auth::user()->credits <= 0 or Auth::user()->credits <
                                                $lesson->credit_cost)
                                                    <a href="{{ route('buy_credits') }}" class="btn btn-danger"><i class="fas fa-cart-plus mr-2"></i>
                                                        Buy more credits</a>
                                                @else
                                                    <a href="{{ route('is-unlocked', [$lesson->id])
                                                        }}" class="btn btn-warning" id="unlock-button"><i
                                                            class="fas fa-unlock mr-2"></i> Unlock for {{ $lesson->credit_cost }}
                                                        @if ($lesson->credit_cost == 1)
                                                            credit
                                                        @else
                                                            credits
                                                        @endif
                                                    </a>
                                                    <div class="d-none"
                                                         id="unlock-message"><small>Unlocking the
                                                            lesson,
                                                            just a
                                                            moment...
                                                        </small></div>
                                                @endif
                                            @endif
                                            @endrole
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>

    </div>
@endsection

@section('bottom_scripts')
    <script>
        $("#unlock-button").click(function (ev) {
            console.log('You clicked!');
            $("#unlock-button").addClass('d-none');
            $('#unlock-message').removeClass('d-none');
        });
    </script>
@endsection
