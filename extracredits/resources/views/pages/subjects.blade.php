@extends('layouts.app')

@section('show_credits')
    @auth
        @role('student')
        <li class="mb-sm-4 mb-md-0 display-6"><strong>Credits: {{ Auth::user()->credits }}</strong></li>
        @endrole
    @endauth
@endsection

@section('content')
<div class="col-12">
    <div class="col-12 mb-4">
        <h1 class="text-center main-heading display-3 mb-3">Subjects</h1>
        <h5 class="text-center text-secondary">All the lessons are divided into main subjects. Click on any icon to view the details.
        </h5>
        @if(session()->has('first_time'))
        <div class="alert alert-warning alert-dismissible fade show text-center font-weight-bold" role="alert">
        This is your first time here. Topup your account with some credits to unlock the lessons inside <a href="{{ route('buy_credits')}}">here </a>.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          </div>
        @endif
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 bg-white rounded shadow p-3">
            <div class="row">
                @foreach ($subjects as $subject)
                <div class="col-12 col-sm-6 col-md-4 p-2 ">
                    <div class="subjects">
                    <a href="{{ route('subjects-view', [$subject->name]) }}">  <img src="images/thumbnails/{{$subject->name}}_thumb.png" class="img-fluid" alt="{{ $subject->name }}"></a>
                    </div>
                  </div>
                    
                @endforeach
            </div>
        </div>
    </div>
</div>
{{ session()->forget('first_time')}}
@endsection
