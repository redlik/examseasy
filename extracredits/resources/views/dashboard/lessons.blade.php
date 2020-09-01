@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow">
    <h4 class="text-white text-center text-uppercase">Dashboard</h4>
    <h6 class="text-white text-center">Hi, {{ Auth::user()->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard') }}" class="text-white"><i
                    class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-warning font-weight-bold"><i
                    class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ url('/lesson/create') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1 pl-4"></i> Add new lesson</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.students') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Students</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.transactions') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Transactions</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.emails') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Emails</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>

</div>
<div class="col-12 col-md-9 px-md-4 mt-sm-4 mt-md-0 pl-md-2">
    <div class="bg-white rounded shadow h-100 p-4 shadow-sm">
        <div class="row">
            <div class="col-12 col-md-8">
                <h2 class="mb-4">List of Lessons</h2>
            </div>
            <div class="col-12 col-md-4">
                <form action="/dashboard/search" method="GET">

                    <div class="col-auto">
                        <label class="sr-only" for="inlineFormInputGroup">Search</label>
                        <input type="text" class="form-control" id="searchInput" name="searchInput" placeholder="Search">
                    </div>
                </form>
            </div>
        </div>
        @isset($search_query)
        <div class="row">
            <div class="col-12">
                <h5>View lessons including: "{{ $search_query }}"</h5>
                <a href="{{ url('dashboard/lessons') }}" class="text-danger mt-3"><i class="fas fa-times-circle"></i> Clear
                    search</a>
            </div>
        </div>
        @endisset
        @isset($selected_category)
        <p class="mb-3">View by category: <strong>{{ $selected_category->name }}</strong></p>
            
        @endisset
        @isset($selected_subject)
        <p class="mb-3">View by subject: <strong>{{ ucfirst($selected_subject->name) }}</strong></p>
            
        @endisset
        <div class="row">
            <div class="col-3">
                <form action="/dashboard/filter" method="get">
                    <div class="form-group">
                        {{-- <label for="subjectSelect">View by subject</label> --}}
                        <select name="selectFilter" id="subjectFilter" class="form-control" onchange="this.form.submit();">
                            <option value="" disabled selected>Select filter</option>
                            @foreach ($subjects as $subject)
                            <option value="sub-{{ $subject->id }}">{{ ucfirst($subject->name) }}</option>
                                @foreach ($subcategories as $subcategory)
                                    @if ($subcategory->subject_id == $subject->id)
                                        <option value="sub{{$subject->id}}_cat-{{ $subcategory->id }}" class="text-secondary">-
                                            {{ $subcategory->name }}</option>
                                    @endif
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                </form>
            </div>
            @isset($selected_category)
            <div class="col-3">
                <a href="{{ url('dashboard/lessons') }}" class="text-danger mt-3"><i class="fas fa-times-circle"></i> Clear
                    filter</a>
            </div>
            @endisset
            @isset($selected_subject)
            <div class="col-3">
                <a href="{{ url('dashboard/lessons') }}" class="text-danger mt-3"><i class="fas fa-times-circle"></i> Clear
                    filter</a>
            </div>
            @endisset
        </div>
        <table class="table table-striped table-hover mt-3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Unlocked</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lessons as $lesson)
                <tr class="{{$lesson->subject->name}}">
                    <th scope="row">{{ $lesson->id }}</th>
                    <td><span class="font-text-bold">{{ $lesson->title }}</span><br>
                        <span class="text-secondary"><small>{{ ucfirst($lesson->subject->name) }} >>
                                {{ $lesson->topic->subcategory->name }} >> {{ $lesson->topic->name }}</small></span>
                    </td>
                    <td>{{ $lesson->user_count }}</td>
                    <td><a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}"
                            class="text-success mr-2" title="View lesson"><i class="far fa-eye"></i></a>
                        <a href="{{ url('/lesson', [$lesson->id, 'edit']) }}" class="text-primary mr-2"
                            title="Edit lesson"><i class="far fa-edit"></i></a>
                        @if ($lesson->user_count < 1) <a href="{{ url('/remove', [$lesson->id]) }}" class="text-danger"
                            title="Delete lesson" onclick="return confirm('Do you want to delete the lesson completely?')"><i class="far fa-trash-alt"></i></a>
                            @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('/lesson/create') }}" class="btn btn-danger text-right"><i class="fas fa-plus mr-2"></i> Add New Lesson</a>
    </div>
</div>
@endsection
