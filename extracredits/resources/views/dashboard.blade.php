@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow">
    <h4 class="text-white text-center text-uppercase">Dashboard</h4>
    <h6 class="text-white text-center">Hi, {{ Auth::user()->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3 text-warning font-weight-bold"><i class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard</li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
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
<div class="col-12 col-md-9 pl-md-4">
    <div class="bg-white rounded shadow h-100 p-4">
        <h2>Dashboard</h2>
        <p>Active students: {{ $active_students }}</p>
        <p>Number of Transactions: {{ $transactions->count() }}</p>
        <p>Income: €{{$transactions->sum('amount') }}</p>
        <p>Number of Unlocked Lessons: {{ $unlocked_lessons->count() }}</p>
    </div>
</div>
@endsection
