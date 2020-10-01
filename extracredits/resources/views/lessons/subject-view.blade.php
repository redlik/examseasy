@extends('layouts.app')

@section('show_credits')
@auth
@role('student')
<li class="mb-sm-4 mb-md-0 display-6"><strong>Credits: {{ Auth::user()->credits }}</strong></li>
@endrole
@endauth
@endsection

@section('content')

<div class="container bg-white rounded-lg shadow p-3">
    <div class="row">
        <div class="col-12">
            <h3 class="text-uppercase font-weight-black">{{ ucfirst($subject->name) }} lessons</h3>
            <p>Click on the topic to view lessons</p>
        </div>
    </div>
    <div class="row mt-3">
        @foreach ($subcategories as $subcategory)

        <div class="col-12 col-md-6">
            <h5 class="bg-light font-weight-bold text-uppercase p-2 rounded shaddow-sm">{{ $subcategory->name }}</h5>

            <div>
                <ul class="list-group list-group-flush">
                    @foreach ($topics as $topic)
                    @if ($topic->subcategory_id == $subcategory->id)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between">
                            <div><a href="{{  route('subject.topic', [$subject->name, $subcategory->slug, $topic->slug])}}" class="unlink text-uppercase font-weight-bold"><span class="text-teal">{{ $topic->name }} <i class="fas fa-arrow-alt-circle-right"></i></span></a></div>
                            <div>{{ $topic->lesson->count() }} 
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
        </div>
        @endforeach
        </ul>
    </div>

</div>


@endsection
