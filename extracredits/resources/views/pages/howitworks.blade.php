@extends('layouts.app')

@section('content')
<div class="col-12 mb-4">
    <h1 class="text-center main-heading display-3">How it works</h1>
    <h4 class="text-center text-secondary">Follow these easy steps to become a member of Exams Made Easy</h4>
</div>
<div class="container">
    <hr class="green-dots">
    <div class="row">
        <div class="col-2 d-flex justify-content-center"><p class="big-number">1</p></div>
        <div class="col-10 col-md-6">
            <h3 class="text-burgundy">Register the account</h3>
            <p>
                Create new account at Exams Made Easy. It’s very simple - we just need your name and email address. You email and password will be used to login into the website, we won’t spam you with offers nor pass your details to any third party services. Your account will be active for 24 months from the date of the registration.
            </p>
            @guest
            <a href="{{ route('register') }}" class="btn btn-pink text-white display-6 font-weight-bold text-uppercase d-inline-block shadow px-4">Register new account</a>    
            @endguest
        </div>
        <div class="col-12 col-md-4 mt-sm-4 mt-md-0">
            <img src="{{ asset('images/step1.svg') }}" alt="" class="img-fluid">
        </div>
    </div>
    <hr class="green-dots">
    <div class="row">
        <div class="col-2 d-flex justify-content-center"><p class="big-number">2</p></div>
        <div class="col-10 col-md-6">
            <h3 class="text-burgundy">Credit top-up</h3>
            <p>
                Our unique credit system allow registered users to unlock only the content they want to see. There’s no pay-for-all mechanism or any monthly fee. Each lesson have a 1 or 2 credit value and your credits will be used to unlock them and view the content. The current number of credits available is displayed at the top of the screen or inside your profile page. You will see a top up button there as well. You can top up anytime you need more credits and we provided couple of credit packages to pick from.
            </p>
            @role('student')
            <a href="{{ route('buy_credits') }}" class="btn btn-success text-white px-2 my-2 text-uppercase">Top up your account</a>    
            @endrole
        </div>
        <div class="col-12 col-md-4 mt-sm-4 mt-md-0">
            <img src="{{ asset('images/step2.svg') }}" alt="" class="img-fluid">
        </div>
    </div>
    <hr class="green-dots">
    <div class="row">
        <div class="col-2 d-flex justify-content-center"><p class="big-number">3</p></div>
        <div class="col-10 col-md-6">
            <h3 class="text-burgundy">Unlock the lessons</h3>
            <p>
                All of the lessons are split between subjects, categories and topics to help you navigate the large library of content. Using your credit allowance unlock the lessons you’d like to watch. They will be available to see as long your account is active. We are constantly adding new content so keep coming back to the site regularly. If you wish you can sign up to our email list to be informed whenever a new content arrives. We are monitoring each account activity so please be kind and don’t share your login with anyone else. By purchasing the credits you support the tutors and allow us to produce more content.
            </p>
            <a href="/subjects" class="btn btn-success text-white text-white display-6 font-weight-bold text-uppercase d-inline-block shadow px-4 my-2">View all lessons</a>    
        </div>
        <div class="col-12 col-md-4 mt-sm-4 mt-md-0">
            <img src="{{ asset('images/step3.svg') }}" alt="" class="img-fluid">
        </div>
    </div>
    <hr class="green-dots">
    <div class="row">
        <div class="col-2 d-flex justify-content-center"><p class="big-number">4</p></div>
        <div class="col-10 col-md-6">
            <h3 class="text-burgundy">Feedback</h3>
            <p>
                We would love to hear from you. If you have any questions or wish to see any specific content please use the form on the contact page and we will get back to you as fast as we can. Your opinion is important to us.
            </p>
            <a href="{{ url('contact') }}" class="btn btn-success text-white text-white display-6 font-weight-bold text-uppercase d-inline-block shadow px-4 my-2">Contact us</a>    
        </div>
        <div class="col-12 col-md-4 mt-sm-4 mt-md-0">
            <img src="{{ asset('images/step4.svg') }}" alt="" class="img-fluid">
        </div>
    </div>
</div>
@endsection
