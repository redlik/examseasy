@extends('layouts.app')

@section('content')
<div class="col bg-white rounded shadow-sm p-4">
    <div class="row">
        <div class="col-3 text-center d-none d-md-block">
            <img src="{{ asset('images/avatar.svg') }}" alt="User Profile image" class="img-fluid" width="200px"
                height="200px">
        </div>
        <div class="col-sm-12 col-md-9">
            <h3 class="mb-4">User name: <strong>{{ Auth::user()->name }}</strong></h3>
            <h4>Number of credits: <strong>{{ $user->credits }}</strong></h4>
            <a href="{{ route('buy_credits') }}" class="btn btn-success mt-2">Buy more credits</a>
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
                            {{-- <th scope="col">Unlocked on</th> --}}
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
                            {{-- <td>{{ Auth::user()->lesson->first()->pivot->created_at->format('d/m/Y') }}</td> --}}
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

@endsection
