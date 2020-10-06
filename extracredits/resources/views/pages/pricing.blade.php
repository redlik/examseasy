@extends('layouts.app')

@section('content')
<div class="col-12 mb-4">
    <h1 class="text-center main-heading display-3">Pricing</h1>
    <h4 class="text-center text-secondary">Our pricing is simple. Buy credits to unlock lessons. No hidden or recurring charges.</h4>
</div>
<div class="container">
    <div class="row text-center">
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold">1 Credit</h2>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">€9.99</h4>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold">5 Credits</h2>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">€39.99</h4>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold">15 Credits</h2>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">€99.99</h4>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold">50 Credits</h2>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">€249.99</h4>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold">100 Credits</h2>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">€349.99</h4>
                        <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 class="text-center font-weight-bold">UNLIMITED</h2>
                    </div>
                    <div class="card-body text-center">
                        <h4 class="card-title text-center">€499.99</h4>
                        <a href="" class="btn btn-primary disabled">Coming Soon</a>
                    </div>
                </div>
            </div>
            
    </div>

</div>

</div>
@endsection
