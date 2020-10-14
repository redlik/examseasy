@extends('layouts.app')

@section('show_credits')
@auth
@role('student')
<div class="credit-box d-flex align-items-center">
    <div class="text-secondary text-small text-center">Credits <br />remaining:</div>
    <div class="credit-number">{{ Auth::user()->credits }}</div>
</div>
@endrole
@endauth
@endsection

@section('content')
<div class="col-12 mb-4">
    <h1 class="text-center main-heading display-3">Pricing</h1>
    @guest
    <h4 class="text-center text-secondary">Our pricing is simple. Buy credits to unlock lessons. No hidden or recurring
        charges.</h4>
    @endguest
</div>
<div class="container">
    <div class="row">
        <div class="col-12 text-center">
            <h6>If you'd like to top-up your account now - click on the button below</h6>
            @role('student')
                <a href="{{ route('buy_credits') }}" class="btn btn-green text-white p-2 px-3 my-4 ml-4 font-weight-bold display-6 shadow"><i class="fas fa-cart-plus mr-2"></i> BUY CREDITS</a>
            @endrole
        </div>
    </div>
    <div class="row text-center">
        <div class="col-12 col-md-6 col-lg-4 mb-3">
            <div class="card shadow">
                <div class="card-header">
                    <h2 class="text-center font-weight-bold">1 Credit</h2>
                </div>
                <div class="card-body text-center">
                    <h4 class="card-title text-center">€9.99</h4>
                    <p class="font-weight-bold"><small>€9.99 per video</small></p>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    @endguest
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
                    <p class="font-weight-bold"><small>€7.99 per video</small></p>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    @endguest

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
                    <p class="font-weight-bold"><small>€6.60 per video</small></p>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    @endguest
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
                    <p class="font-weight-bold"><small>€5.00 per video</small></p>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    @endguest
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
                    <p class="font-weight-bold"><small>€3.49 per video</small></p>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    @endguest
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
