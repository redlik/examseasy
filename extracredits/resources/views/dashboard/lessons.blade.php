@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow">
    <h4 class="text-white text-center text-uppercase">Dashboard</h4>
    <h6 class="text-white text-center">Hi, {{ Auth::user()->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard') }}" class="text-white"><i class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-warning font-weight-bold"><i class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ url('/lesson/create') }}" class="text-white"><i class="fas fa-chevron-right pr-1 pl-4"></i> Add new lesson</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.students') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Students</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.transactions') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Transactions</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.emails') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Emails</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>

</div>
<div class="col-12 col-md-9 px-md-4 mt-sm-4 mt-md-0">
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
            <a href="{{ url('dashboard/lessons') }}" class="text-danger mt-3"><i class="fas fa-times-circle"></i> Clear search</a>
        </div>
    </div>
    @endisset
            <table class="table table-striped table-hover mt-3">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-6">Title</th>
                        <th scope="col" class="col-2">Unlocked</th>
                        <th scope="col" class="col-3">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                    <tr class="{{$lesson->subject->name}}">
                        <th scope="row">{{ $lesson->id }}</th>
                        <td><span class="font-text-bold">{{ $lesson->title }}</span><br>
                            <span class="text-secondary"><small>{{ ucfirst($lesson->subject->name) }} >> {{ $lesson->topic->subcategory->name }} >> {{ $lesson->topic->name }}</small></span>
                            </td>
                        <td>{{ $lesson->user_count }}</td>
                        <td><a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}" class="text-success mr-2">View</a>
                            <a href="{{ url('/lesson', [$lesson->id, 'edit']) }}" class="text-primary mr-2">Edit</a>
                            @if ($lesson->user_count < 1) <a href="{{ url('/remove', [$lesson->id]) }}" class="text-danger">Delete</a>
                                @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <a href="{{ url('/lesson/create') }}" class="btn btn-danger text-right">Add New</a>
</div>
@endsection
