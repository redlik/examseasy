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
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i>
                Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.students') }}" class="text-warning font-weight-bold"><i
                    class="fas fa-chevron-right pr-1"></i> Students</a></li>
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Transactions</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Emails</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>

</div>
<div class="col-12 col-md-9 p-md-4 mt-sm-4 mt-md-0 bg-white rounded">
    <div class="row">
        <div class="col-12 col-md-8">
            <h2 class="mb-4">List of Students</h2>
        </div>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" class="col-1">#</th>
                <th scope="col" class="col-3">Name</th>
                <th scope="col" class="col-3">Email</th>
                <th scope="col" class="col-2">Registered</th>
                <th scope="col" class="col-1">Credits</th>
                <th scope="col" class="col-2">Operations</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
            @switch(true)
                @case($student->credits == 0)
                    <tr class="alert alert-danger">
                    @break
                @case($student->credits < 10)
                <tr class="alert alert-warning">
                    @break
                @default
                <tr class="">
            @endswitch
            
                <th scope="row">{{ $student->id }}</th>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->created_at->format('d/m/Y') }}</td>
                @if ($student->credits < 10)
                <td class="text-danger font-weight-bold">{{ $student->credits }}</td>
                @else
                <td>{{ $student->credits }}</td>
                @endif
                
                <td><a href="{{ route('user_panel', [$student->id]) }}" class="btn btn-green text-white">View details</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
