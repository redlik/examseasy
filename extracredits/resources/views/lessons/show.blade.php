@extends('layouts.app')
@section('extra_scripts')
<script src="https://player.vimeo.com/api/player.js"></script>

@endsection

@section('content')
<div class="col bg-white rounded shadow-sm p-2">
    <div id="vimeo-player"></div>
    <h1 class="font-weight-bold my-2">{{ $lesson->title}}</h1>
    <a href="{{ route('subjects-view', [$lesson->subject->name]) }}">{{ ucfirst($lesson->subject->name) }}</a> >> <a href="{{  route('subject.topic', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug])}}">{{ $lesson->topic->name }}</a>
    <p class="my-2">{!! nl2br($lesson->description) !!}</p>

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