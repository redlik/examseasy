@extends('layouts.app')

@section('meta')
    @include('meta::manager', [
        'title'         => 'Pricing | Exams Made Easy - Leaving Cert Exams Preparation',
        'description'   => 'Our unique credit system allows you to unlock only the content you want to see. No monthly fees.',
        'image'         => 'images/eme-logo.svg',
    ])
@endsection

@section('show_credits')
    <x-creditbox />
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
            @role('student')
            <h6>If you'd like to top-up your account now - click on the button below</h6>
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
                    <h4 class="card-title text-center">€4.99</h4>
                    <p class="font-weight-bold"><small>€4.99 per credit<sup>*</sup></small></p>
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
                    <h4 class="card-title text-center">€19.99</h4>
                    <p class="font-weight-bold"><small>€3.99 per credit<sup>*</sup></small></p>
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
                    <h4 class="card-title text-center">€49.99</h4>
                    <p class="font-weight-bold"><small>€3.34 per credit<sup>*</sup></small></p>
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
                    <h4 class="card-title text-center">€149.99</h4>
                    <p class="font-weight-bold"><small>€2.99 per credit<sup>*</sup></small></p>
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
                    <h4 class="card-title text-center">€249.99</h4>
                    <p class="font-weight-bold"><small>€2.49 per credit<sup>*</sup></small></p>
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
                    <p class="font-weight-bold"><small>Unlimited access to all videos</small></p>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-primary">Sign up now</a>
                    @endguest
                </div>
            </div>
        </div>

    </div>
    <div class="row text-center">
        <p class="mx-auto">* Most of our videos have 1 credit cost but there are few, longer ones, which will cost 2 credits from your allowance.</p>
    </div>
    

</div>

</div>
@endsection
