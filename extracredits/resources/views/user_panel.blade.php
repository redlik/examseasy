@extends('layouts.app')

@section('content')
<div class="col">
    <a class="btn btn-primary mb-4" href="{{ route('dashboard') }}/#users"> << Back to dashboard</a>
    <h3 class="mb-4">User name: <strong>{{ $user->name }}</strong></h3>
    <h4>Number of credits: <strong>{{ $user->credits }}</strong></h4>
    <a href="{{ route('buy_credits') }}" class="btn btn-success">Buy more credits</a>
    <hr>
    <p>Registered at: {{ $user->created_at->format('d/m/Y') }}</p>
    <h4 class="mt-4">Unlocked content</h4>
    <ul>
        @foreach ($lessons as $lesson)
            <li>{{ $lesson->title }}</li>
        @endforeach
    </ul>
</div>
    
@endsection