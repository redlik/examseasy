@extends('layouts.app')

@section('extra_scripts')
<script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
@endsection

@section('extra_styles')
<link href="{{ asset('css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
@endsection

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
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.categories') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Categories & Topics</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.paperadvice') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Paper Advice Videos</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.students') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Students</a></li>
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.transactions') }}" class="text-warning font-weight-bold"><i class="fas fa-chevron-right pr-1"></i> Transactions</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.emails') }}" class="text-white"><i
            class="fas fa-chevron-right pr-1"></i> Emails</a></li>
        <hr class="sidebar-rule">
        <li class="pl-3 mb-3"><a href="{{ route('dashboard.coupons') }}" class="text-white"><i
                    class="fas fa-chevron-right pr-1"></i> Coupons</a></li>
    </ul>
</div>

<div class="col-12 col-md-9 overflow-auto mt-sm-4 mt-md-0 pl-md-4 h-100 pb-4">
    <div class="bg-white rounded shadow h-100 p-4 shadow-sm">
        <h2 class='font-weight-bold text-uppercase mb-4'>List of transactions</h2>
                <table class="table">
                    <thead class="thead-dark rounded">
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">User</th>
                            <th scope="col">Charge</th>
                            <th scope="col">Credits</th>
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
                            <td>{{ $transaction->user->name }}</td>
                            <td>€{{ $transaction->amount }}</td>
                            <td>{{ $transaction->credit_topup }}</td>
                            <td>{{ $transaction->name_on_card }}</td>
                            <td>{{ $transaction->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $transactions->links() }}
    </div>

</div>

@endsection

