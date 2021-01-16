@extends('layouts.app')

@section('extra_scripts')
    <script src="{{ asset('js/html5lightbox.js') }}"></script>
@endsection

@section('show_credits')

@endsection

@section('content')

<div class="col-12 ">
    <h1 class="text-center main-heading">Exam Papers Advice</h1>
    <div class="mb-4 text-center">
        <h5>In this section we provide some advice and tips on how to</h5>
    </div>
    <div class="row">
       @foreach ($videos as $video)
            <div class="col-6 mb-5">
                <div class="d-flex flex-row align-items-center bg-light rounded-2 shadow p-4">
                    <div class="mr-4">
                        <a href="https://player.vimeo.com/video/{{ $video->link }}" class="html5lightbox" title="{{ $video->title }}">
                        <i class="far fa-play-circle fa-6x text-primary"></i>
                        </a>
                    </div>
                    <div class="">
                        <a href="https://player.vimeo.com/video/{{ $video->link }}" class="html5lightbox" title="{{ $video->title }}">
                        <h3>{{ ucfirst($video->title) }}</h3>
                        </a>
                    </div>
                </div>
            </div>
            </a>
       @endforeach

    </div>
    <ul>
    </ul>
</div>
@endsection
