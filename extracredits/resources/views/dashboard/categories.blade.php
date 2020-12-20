@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow" style="height:90%">
    <h4 class="text-white text-center text-uppercase">Categories & Topics</h4>
    <h6 class="text-white text-center">Hi, {{ Auth::user()->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard') }}" class="text-white"><i
                    class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-warning font-weight-bold"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
                    <ul class="text-white list-unstyled">
                        @foreach ($subjects as $subject)
                        <li class="pl-3 mb-3"><a href="{{ route('dashboard.subjects', [$subject->name]) }}" class="text-white"><i
                            class="fas fa-chevron-right pr-1 pl-4"></i> {{ ucfirst($subject->name) }}</a></li>
                        @endforeach
                    </ul>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.paperadvice') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Paper Advice Videos</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.students') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Students</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.transactions') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Transactions</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.emails') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Emails</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-white"><i class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>
</div>

<div class="col-12 col-md-9 overflow-auto mt-sm-4 mt-md-0 pl-md-4 h-100 pb-4">
    <div class="bg-white rounded shadow h-100 p-4 shadow-sm">
        <h2 class='font-weight-bold text-uppercase'>Categories & Topics</h2>
        <ul class="list-group">
            @foreach ($subjects as $subject)
            
            <li class="list-group-item font-weight-bold d-flex justify-content-between align-items-center">
                {{ ucfirst($subject->name) }} - {{ $subject->subcategory()->count() }} 
                @if ( $subject->subcategory()->count() == 1)
                    category
                @else
                    categories
                @endif
                <a href="{{ route('dashboard.subjects', [$subject->name]) }}" class="btn btn-green text-white" >View details</a></li>
            @endforeach
        </ul>
    </div>
</div>
@endsection