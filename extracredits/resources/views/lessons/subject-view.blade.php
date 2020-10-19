@extends('layouts.app')

@section('show_credits')
    <x-creditbox />
@endsection

@section('content')

<div class="container bg-white rounded-lg shadow p-3">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-uppercase font-weight-black">{{ ucfirst($subject->name) }} lessons</h1>
            <p>Click on individual topic to view lessons</p>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-9 mx-auto">
            @if (in_array($subject->id, $hiddenSubjects))
            <div class="text-center mx-auto mt-4 text-secondary">
                <img src="{{ asset('images/coming-soon.svg')}}" alt="coming soon icon">
                <h3 class="mt-3">Content coming soon</h3>
            </div>
            @else
            @foreach ($subcategories as $subcategory)

            <div
                class="d-flex justify-content-between align-items-center bg-light rounded shaddow-sm mt-2 w-100 position-relative">
                <h5 class="font-weight-bold text-uppercase p-2">{{ $subcategory->name }}</h5>
                @if ($subcategory->topic->count()>0)
                <div class="open-menu collapsed p-2" data-toggle="collapse"
                    data-target="#collapse-{{ $subcategory->slug }}" role="heading" aria-expanded="false"><i
                        class="fa fa-plus-circle"></i></div>
                @endif
            </div>
            <div class="collapse" id="collapse-{{ $subcategory->slug }}" aria-expanded="false" style="height:0px">
                <ul class="list-group list-group-flush">
                    @foreach ($topics as $topic)
                    @if ($topic->subcategory_id == $subcategory->id)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div><a href="{{  route('subject.topic', [$subject->name, $subcategory->slug, $topic->slug])}}"
                                    class="unlink text-uppercase font-weight-bold"><span
                                        class="text-teal">{{ $topic->name }} <i
                                            class="fas fa-arrow-alt-circle-right"></i></span></a></div>
                            <div style="white-space: nowrap">{{ $topic->lesson->count() }}
                                @if ($topic->lesson->count() == 1)
                                Lesson
                                @else
                                Lessons
                                @endif

                            </div>
                        </div>
                    </li>
                    @endif

                    @endforeach
                </ul>
            </div>

            @endforeach
        @endif
        </div>
    </div>

</div>


@endsection
