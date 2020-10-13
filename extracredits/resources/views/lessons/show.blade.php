@extends('layouts.app')
@section('extra_scripts')
<script src="https://player.vimeo.com/api/player.js"></script>

@endsection

@section('show_credits')
    @auth
        @role('student')
        <div class="credit-box d-flex align-items-center"><div class="text-secondary text-small text-center">Credits <br/>remaining:</div><div class="credit-number">{{ Auth::user()->credits }}</div></div>
        @endrole
    @endauth
@endsection

@section('content')
<div class="col bg-white rounded shadow-sm p-2">
    @role('student')
      @isset($unlocked)
        @if ($unlocked)
          <div id="vimeo-player"></div>
        @else
        <div class="d-flex justify-content-center align-items-center" style="height:300px">
            <i class="far fa-frown-open mr-2" style="font-size: 5rem; color: #bfbfbf"></i>
            <h3 class="text-center">Looks like you have't unlocked that video with your credits. </br/>Go back and unlock it first.</h3>
        </div>
        @endif
      @endisset
    @endrole

    @role('teacher|superadmin')
      <div id="vimeo-player"></div>
    @endrole
    
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