@extends('layouts.app')

@section('extra_scripts')
<script src="{{ asset('js/html5lightbox.js') }}"></script>
@endsection

@section('content')
<div class="container mb-3">
    <div class="row">
        <div class="col-12 bg-pink text-center text-white rounded shadow-sm">
            <h3 class='pt-1'>New content added regularly!</h3>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12">
    <div class="d-flex align-content-center">
        <div class="py-3">
            <h3 class="display-4 main-heading text-teal">Study your way</h3>
            <h2 class="display-2 main-heading text-teal">to success</h2>
            <p class="my-3 display-6">ExtraCredit is an online service trusted by thousands of second-level students and
                their
                parents across Ireland when preparing for exams. It is the modern alternative to grinds. <strong>Our
                    unique credit system allows to only unlock the contact you need.</strong></p>

            <a href="{{ route('register') }}" class="btn btn-pink text-white p-3 my-4 font-weight-bold display-6 shadow">SIGN-UP NOW</a>
        </div>

    </div>
</div>
<div class="col-md-6 col-sm-12">
    <img src="{{ asset('images/home-hero.svg') }}" alt="extra credit home page">
</div>

<section class="bg-blue my-4 py-4 container rounded shadow-sm">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="main-heading text-center">
                Reasons to join Exams Made Easy
            </h2>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-4 text-center px-4">
            <img src="{{ asset('images/teacher.svg') }}" width="90px" class="mb-3" alt="">
            <h4 class="text-uppercase font-weight-black">Experienced Tutors</h4>
            <p>Our tutors have many years of experience teaching and preparing students for their exams.</p>
        </div>
        <div class="col-12 col-md-4 text-center px-4">
            <img src="{{ asset('images/sheet.svg') }}" height="77px" class="mb-3" alt="">
            <h4 class="text-uppercase font-weight-black">Real Exams Questions</h4>
            <p>All lessons are based on previous exams. Unlock only those you need to study.</p>
        </div>
        <div class="col-12 col-md-4 text-center">
            <img src="{{ asset('images/tutorial.svg') }}" height="77px" class="mb-3" alt="">
            <h4 class="text-uppercase font-weight-black">Evergrowing library</h4>
            <p>We have started with over 200 lessons but our library will grow as we are adding new content regularly.
            </p>
        </div>
    </div>
</section>

<section class="container my-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="main-heading text-center display-5">
                Sample content to help you get the taste...
            </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3">
            <a href="https://player.vimeo.com/video/453378723" class="html5lightbox" title="Irish Sample Video">
                <img src="{{ asset('images/irish_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="https://player.vimeo.com/video/453899480" class="html5lightbox" title="Geography Sample Video">
                <img src="{{ asset('images/geography_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="https://player.vimeo.com/video/453091289" class="html5lightbox" title="Biology Sample Video">
                <img src="{{ asset('images/biology_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <a href="https://player.vimeo.com/video/454688432" class="html5lightbox" title="Accounting Sample Video">
                <img src="{{ asset('images/accounting_sample.png') }}" class="img-fluid"></a>
        </div>
    </div>
    <hr class="my-5">
</section>

<!-- Section: Testimonials -->
<section class="my-4 container">

    <!-- Grid row -->
    <div class="row d-flex align-items-center">
        <div class="col-12 col-md-6 text-left order-sm-2 order-md-1">
            <h2 class="main-heading display-5 my-3">Simple pricing</h2>
            <p class="display-6">
                Our unique credit system allow registered users to unlock only the content they want to see. There’s no
                pay-for-all mechanism or any monthly fee. Each lesson have a 1 or 2 credit value and your credits will
                be used to unlock them and view the content. You can top up anytime you need more credits and we
                provided couple of credit packages to pick from. The content you've unlocked stays that way till your
                account is no longer active.
            </p>
        </div>
        <div class="col-12 col-md-6 order-sm-1 order-md-2">
            <img src="{{ asset('images/step2.svg') }}" alt="" class="img-fluid mx-auto d-block" style="height:300px;">
        </div>
    </div>
    <!--Grid column-->

    </div>
    <!-- Grid row -->

</section>

<section class="container bg-pink rounded-lg">
    <div class="row d-flex align-items-center">
        <div class="col-12 col-md-9 text-white text-center p-2">
            <h2 class="main-heading display-5">Let's get started!</h2>
        </div>
        <div class="col-12 col-md-3 my-3">
            <a href="{{ route('register') }}" class="btn btn-light display-6 font-weight-bold text-uppercase d-block mx-auto shadow px-4 w-75">Sign Up Now!</a>
        </div>
    </div>

</section>

@endsection
