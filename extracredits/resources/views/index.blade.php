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
            <h5 class="font-weight-bold" style="font-size: 150%">Tired of paying for content you don’t need?</h5>
            <p class="my-3 display-6">Examsmadeeasy.ie is an online service that gives you the freedom to personalise your revision schedule. Our videos are delivered by our team of experienced teachers and are tailored to each subject and its required content, section by section and topic by topic.<br/> <strong>Our unique credit system allows you to only unlock the content that you need.</strong></p>

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
            <p>All video content is based on previous State examination Papers. You only unlock the content that you need to study.</p>
        </div>
        <div class="col-12 col-md-4 text-center">
            <img src="{{ asset('images/tutorial.svg') }}" height="77px" class="mb-3" alt="">
            <h4 class="text-uppercase font-weight-black">Evergrowing library</h4>
            <p>With over 120 lessons uploaded to date, our library of content will continue to grow as we constantly add new content.
            </p>
        </div>
    </div>
</section>

<section class="container my-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="main-heading text-center display-5">
                Free Subject Content
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
            <a href="https://player.vimeo.com/video/461587553" class="html5lightbox" title="Accounting Sample Video">
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
                Our unique credit system allows registered users to unlock only the content that they need.  There is no pay-for- all mechanic and no monthly fee.  Each lesson will have a 1 or 2 credit value, depending on the length of the video presentation.  Your credits are used to unlock this content for 24 months and allows you to view the content unlocked any time you want. You can top up with extra credits anytime you need more from the range of credit packages that we offer.
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
