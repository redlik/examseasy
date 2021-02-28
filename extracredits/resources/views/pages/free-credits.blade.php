@extends('layouts.app')

@section('full-width-content')
    <div class="container-fluid mt-sm-n4" id="landing-page">
        <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-12 d-flex align-items-center">
                            <div>
                                <h1 class="landing-h1">Sign up for FREE today</h1>
                                <h2 class="landing-h2">and receive 5 FREE credits</h2>
                                <p class="mt-4 font-weight-bold text-secondary">
                                    Looking for simple, flexible and exam focused online grinds?<br/>
                                    Look no further, Exams Made Easy is here to help!
                                </p>
                                <ul class="text-secondary landing-list">
                                    <li>5 credits will give you access to up to 5 topic specific lessons – across 11 leaving certificate subjects.</li>
                                    <li>Sign up for FREE</li>
                                    <li>Lessons taught by <strong>REAL</strong> teachers who are passionate about helping you succeed.</li>
                                    <li>Personalise your study schedule with on demand content.</li>
                                    <li>100% flexibility with our pay as you go system means you only pay for the lessons you want, when you want them.</li>
                                </ul>
                                <a href="{{ route('register') }}">
                                    <button class="btn btn-pink btn-lg btn-landing btn-block text-uppercase">Claim free
                                        credits
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="d-flex align-items-center justify-content-start">
                                <img src="{{ asset('images/landing-page.png') }}" class="landing-img" alt="extra credit home page">
                            </div>
                        </div>
                </div>
            </div>

        </div>
    </div>

@endsection
