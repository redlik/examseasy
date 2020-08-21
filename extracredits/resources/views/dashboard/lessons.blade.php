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
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Students</li>
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Transactions</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Emails</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Coupons</li>
    </ul>

</div>
<div class="col-12 col-md-9 px-md-4 mt-sm-4 mt-md-0">
    <h2 class="mb-4">List of Lessons</h2>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col" class="col-1">#</th>
                        <th scope="col" class="col-6">Title</th>
                        <th scope="col" class="col-1">Unlocked</th>
                        <th scope="col" class="col-4">Operations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lessons as $lesson)
                    <tr class="{{$lesson->subject->name}}">
                        <th scope="row">{{ $lesson->id }}</th>
                        <td><span class="font-text-bold">{{ $lesson->title }}</span><br>
                            <span class="text-secondary">{{ ucfirst($lesson->subject->name) }} >> {{ $lesson->topic->name }} </span>
                            </td>
                        <td>{{ $lesson->user_count }}</td>
                        <td><a href="{{ url('/lesson', [$lesson->id]) }}" class="text-success mr-2">View</a>
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
