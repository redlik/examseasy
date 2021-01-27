@extends('layouts.app')

@section('extra_scripts')
    <script src="{{ asset('js/html5lightbox.js') }}"></script>
@endsection

@section('show_credits')

@endsection

@section('content')

<div class="col-12 ">
    <h1 class="text-center main-heading display-4">Exam Papers Advice</h1>
    <div class="mb-4 text-justify">
        <div class="text-secondary lh-lg fs-5" style="font-size: 1.1rem;">On Exams Made Easy we aim to make the exam
            papers accessible and
            understandable
            for all.
            In this
            selection of short videos, we will guide you through the layout of the exam paper.
            We will show you how the paper is structured into different sections, what is being asked in each and how
            each question should be approached.<br/>
            Time allocation is also key and we discuss the amount of time necessary for each question that you chose
            to do. <br>
            We point out the pitfalls to avoid and indeed the best ways to excel in your efforts in order to maximise
            your marks and achieve your exam potential.</div>
    </div>
    <div class="row">
       @foreach ($videos as $video)
            <div class="col-12 col-md-6 mb-5">
                <div class="d-flex flex-row align-items-center bg-light rounded-2 shadow p-4">
                    <div class="mr-4">
                        <a href="https://player.vimeo.com/video/{{ $video->link }}" class="html5lightbox"
                           title="{{ $video->title }}">
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
