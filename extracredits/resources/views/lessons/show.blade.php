@extends('layouts.app')
@section('extra_scripts')
<script src="https://player.vimeo.com/api/player.js"></script>

@endsection

@section('content')
<div class="col">
    <div id="vimeo-player"></div>
    <h1>{{ $lesson->title}}</h1>
    <p class="my-2">{{ $lesson->description }}</p>
    <a href="{{ route('subjects-view', [$lesson->subject->name]) }}" class="btn btn-primary mr-4"><i class="fas fa-chevron-circle-left"></i> Back to <span class="text-capitalize">{{ $lesson->subject->name }}</span> </a>
    <a href="{{ route('lessons-list') }}" class="btn btn-success"><i class="fas fa-chevron-circle-left"></i> Back to all lessons</a>
</div>
@endsection

@section('bottom_scripts')
<script>
    var divWidth = document.getElementById('vimeo-player').clientWidth;
    var link = '{{ $lesson->link}}';
    var options = {
      url: link,
      width: divWidth,
    };
    console.log(divWidth);
    var videoPlayer = new Vimeo.Player('vimeo-player', options);

    videoPlayer.on('play', function() {
      console.log('Played the first video');
    });
</script>
@endsection