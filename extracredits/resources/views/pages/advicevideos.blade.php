@extends('layouts.app')

@section('show_credits')
    
@endsection

@section('content')

<div class="col-12 ">
    <h1 class="text-center main-heading">Exam Paper Tips</h1>

    <div class="row">
       @foreach ($videos as $video)
           
       @endforeach

    </div>
    <ul>
    </ul>
</div>
@endsection
