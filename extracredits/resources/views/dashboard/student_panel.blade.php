@extends('layouts.app')

@section('content')
<div class="col-12 col-md-3 bg-dark rounded p-3 shadow" style="height:90%">
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
        <a href="{{ URL::previous() }}"><< Back to list</a>
        <div class="row mt-4">
            <div class="col-3 text-center d-none d-md-block">
                <img src="{{ asset('images/avatar.svg') }}" alt="User Profile image" class="img-fluid" width="200px"
                    height="200px">
            </div>
            <div class="col-sm-12 col-md-9">
                <h3 class="mb-4">User name: <strong>{{ $user->name }}</strong></h3>
                <h4>Number of credits: <strong>{{ $user->credits }}</strong></h4>
                <h6 class="my-3">Email: <strong>{{ $user->email }}</strong></h6>
                <h6>Registration date: <strong>{{ $user->created_at->format('d/m/Y') }}</strong></h6>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
                @if (session()->has('success_message'))
                <div class="spacer"></div>
                <div class="alert alert-success my-4">
                    {{ session()->get('success_message') }}
                </div>
                @endif
                <h4 class="my-4">List of unlocked content</h4>
                    <table class="table">
                        <thead class="thead-dark rounded">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Unlocked on</th>
                                <th scope="col">Credit cost</th>
                                <th scope="col">Operations</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lessons as $lesson)
                            <tr>
                                <th scope="row">
                                    {{ $lesson->title }}<br>
                                    <span class="text-secondary"><small>{{ ucfirst($lesson->subject->name) }} >>
                                            {{ $lesson->topic->subcategory->name }} >> {{ $lesson->topic->name }}</small></span>
                                </th>
                                <td></td>
                                {{-- <td>{{ $lesson->pivot->created_at->format('d/m/Y') }}</td> --}}
                                <td>{{ $lesson->credit_cost }}</td>
                                <td><a href="{{ route('lesson_canonical_view', [$lesson->subject->name, $lesson->topic->subcategory->slug, $lesson->topic->slug, $lesson->slug]) }}"
                                        class="text-success mr-2" title="View lesson"><i class="far fa-eye"></i> View lesson</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                <h4 class="my-4">List of transactions</h4>
                    <table class="table">
                        <thead class="thead-dark rounded">
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Charge</th>
                                <th scope="col">Credit top-up</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                            <tr>
                                <th scope="row">
                                    {{ $transaction->created_at->format('d/m/Y') }}<br>
                                </th>
                                <td>€{{ $transaction->amount }}</td>
                                <td>{{ $transaction->credit_topup }}</td>
                                <td>{{ $transaction->name_on_card }}</td>
                                <td>{{ $transaction->email }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
            </div>
        </div>
    </div>
</div>
@endsection
