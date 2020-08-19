@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow">
    <h4 class="text-white text-center text-uppercase">Categories & Topics</h4>
    <h6 class="text-white text-center">Hi, {{ $user->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard') }}" class="text-white"><i class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-warning font-weight-bold"><i class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Students</li>
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Transactions</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Emails</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><i class="fas fa-chevron-right pr-1"></i> Coupons</li>
    </ul>

</div>
<div class="col-12 col-md-9">
    <h2 class='font-weight-bold text-uppercase'>Categories & Topics</h2>
    <ul class="list-group">
    @foreach ($subjects as $subject)
        <li class="list-group-item font-weight-bold d-flex justify-content-between align-items-center">{{ ucfirst($subject->name) }} 
            <span class="badge badge-primary badge-pill p-2">Add Category</span></li>
    @endforeach
    </ul>
</div>
@endsection
