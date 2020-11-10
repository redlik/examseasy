@extends('layouts.app')

@section('meta')
    @include('meta::manager', [
        'title'         => 'How it works | Exams Made Easy - Leaving Cert Exams Preparation',
        'description'   => 'Leaving Exams video tutorials',
        'image'         => 'images/eme-logo.svg',
    ])
@endsection

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
                Create your new account at ExamsMadeEasy.ie. It is remarkably simple; we just need your name and email address.  We will not spam you with incessant offers and we will not pass on your details to any third-party services. Your account is active for 24 months from the date of your initial registration.
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
                Our unique credit system allows registered users to unlock only the content that they need. There is no pay-for-all mechanism and there is no monthly fee. Video content will have a 1 or 2 credit value, you use your acquired credits to unlock them. Once unlocked they are yours to view as long as your account is active. Your student profile homepage will display your current number of credits, with a top up option should you need more credits at any time. We offer a comprehensive range of credit package options, ranging from 1 credit to an unlimited credit option.
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
                Videos are split between subjects, categories, and topics to help you navigate quickly to the content that you need. Once unlocked the content is available as long as your account is active. We are constantly adding new content to increase the library of content available to you the student. Once registered you can, if you wish, sign up to our email list to be informed when new content is posted to the site. We do monitor account activity so please be kind and do not share your personal login details with anyone else. By purchasing credits and registering with ExamsMadeEasy.ie you are supporting the tutors in creating original content.
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
                We would love to hear from you.  If you have any questions or would like to see specific content in a particular subject area produced please contact us. You can use the form on the contact us page and we will get back to you as quickly as possible. Your opinion is important to us as we strive to improve the quality and breadth of content available. Thank you.
            </p>
            <a href="{{ url('contact') }}" class="btn btn-success text-white text-white display-6 font-weight-bold text-uppercase d-inline-block shadow px-4 my-2">Contact us</a>    
        </div>
        <div class="col-12 col-md-4 mt-sm-4 mt-md-0">
            <img src="{{ asset('images/step4.svg') }}" alt="" class="img-fluid">
        </div>
    </div>
</div>
@endsection
