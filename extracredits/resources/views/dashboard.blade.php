@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow">
    <h4 class="text-white text-center text-uppercase">Dashboard</h4>
    <h6 class="text-white text-center">Hi, {{ Auth::user()->name ?? ''}}</h6>
    <hr class="sidebar-rule">
    <ul class="sidebar-menu text-white list-unstyled">
        <li class="pl-3 mb-3 text-warning font-weight-bold"><i class="fas fa-fw fa-tachometer-alt pr-1"></i> Dashboard
        </li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.lessons') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Lessons</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.paperadvice') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Paper Advice Videos</a></li>
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
<div class="col-12 col-md-9 pl-md-4">
    <div class="bg-white rounded shadow h-100 p-4">
        <h2>Dashboard</h2>
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Students
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $active_students }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-1">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Number of lessons
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $lessons_number }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Unlocked lessons
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $unlocked_lessons->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-unlock fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Number of top-ups
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $transactions->count() }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-1">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Earnings
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">€{{$transactions->sum('amount') }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-coins fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h4>Lessons by number of unlocks</h4>
            </div>
            <div class="col-12">
                <table class="table table-striped">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">Title</th>
                        <th scope="col">No. of unlocks</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($best_lessons as $best_lesson)
                        @if ($best_lesson->user->count() > 0 )
                        <tr>
                            <th scope="row">{{ $best_lesson->title }}</th>
                            <td>{{ $best_lesson->user->count() }}</td>
                          </tr>
                        @endif
                    @endforeach
                      
                    </tbody>
                  </table>
                
                {{ $best_lessons->links() }}
            </div>
          
        </div>
    </div>
</div>

@endsection


@section('bottom_scripts')
<script src="{{ asset('js/sb-admin.min.js') }}"></script>
@endsection
