@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="col-12 mb-4">
        <h1 class="text-center main-heading display-3 mb-3">Subjects</h1>
        <h5 class="text-center text-secondary">All the lessons are divided into main subjects. Click on any icon to view the details.
        </h5>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-12 col-md-9 mx-auto bg-white rounded shadow p-3">
            <div class="row">
                @foreach ($subjects as $subject)
                <div class="col-12 col-sm-6 col-md-4 p-1">
                    <div class="bg-light p-2 rounded shadow">
                    <a href="{{ route('subjects-view', [$subject->name]) }}">  <img src="images/thumbnails/{{$subject->name}}.png" class="img-fluid" alt="{{ $subject->name }}"></a>
                    </div>
                  </div>
                    
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
