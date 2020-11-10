@extends('layouts.app')

@section('meta')
    @include('meta::manager', [
        'title'         => 'Exams Made Easy - Leaving Cert Exams Preparation',
        'description'   => 'Exams Made Easy will help you prepare for the Leaving Cert exam. We go through all previous exam questions in very detail',
        'image'         => 'images/eme-logo.svg',
    ])
@endsection

@section('extra_styles')
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
<style>
    #html5-watermark {
        display: none !important;
    }
</style>
@endsection

@section('extra_scripts')
<script src="{{ asset('js/html5lightbox.js') }}"></script>
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
@endsection

@section('content')
<div class="container mb-3">
    <div class="row">
        <div class="col-12 bg-pink text-center text-white rounded shadow-sm">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <h3 class='pt-1'>New videos added regularly!</h3>
                  </div>
                  <div class="carousel-item">
                    <h3 class='pt-1'>Focus on Leaving Certificate content</h3>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-6 col-sm-12">
    <div class="d-flex align-content-center">
        <div class="py-3">
            <h3 class="display-4 main-heading text-teal">Study your way</h3>
            <h2 class="display-2 main-heading text-teal">to success</h2>
            <h5 class="font-weight-bold" style="font-size: 150%">Tired of paying for content you don’t need?</h5>
            <p class="my-3 display-6">
                <ul>
                    <li class="display-6">Our unique credit system allows you to unlock only the content you need </li>
                    <li class="display-6">Freedom to personalise your revision schedule</li>
                </ul>
            </p>
            @guest
            <a href="{{ route('register') }}" class="btn btn-pink text-white p-2 px-3 my-4 mr-4 font-weight-bold display-6 shadow">SIGN-UP NOW</a>
            @endguest
            @role('student')
                <a href="{{ route('buy_credits') }}" class="btn btn-green text-white p-2 px-3 my-4 font-weight-bold display-6 shadow"> <i class="fas fa-cart-plus mr-2"></i> BUY CREDITS</a>
            @endrole
        </div>

    </div>
</div>
<div class="col-md-6 col-sm-12 text-center">
    <a href="https://player.vimeo.com/video/467333894" class="html5lightbox" title="Introduction video">
    <img src="{{ asset('images/home-hero.svg') }}" alt="extra credit home page">
    <button class="btn btn-primary mt-3"><i class="fas fa-play"></i> Introduction video</button>
    </a>
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
            <h4 class="text-uppercase font-weight-black">Real Exam Questions</h4>
            <p>All video content is based on previous State Examination Papers. You only unlock the content that you need to study.</p>
        </div>
        <div class="col-12 col-md-4 text-center">
            <img src="{{ asset('images/tutorial.svg') }}" height="77px" class="mb-3" alt="">
            <h4 class="text-uppercase font-weight-black">Expanding Library</h4>
            <p>With over 120 lessons uploaded to date, our library of content will continue to grow as we constantly add new content.
            </p>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12 col-md-4 text-center mx-auto">
            <img src="{{ asset('images/atom.svg') }}" height="77px" class="mb-3" alt="">
            <h4 class="text-uppercase font-weight-black">Freedom of Choice</h4>
            <p>Choose the content that is relevant to your needs. Exam&nbsprevision on the go to suit your busy lifestyle.</p>
        </div>
        <div class="col-12 col-md-4 text-center mx-auto">
            <img src="{{ asset('images/rating.svg') }}" height="77px" class="mb-3" alt="">
            <h4 class="text-uppercase font-weight-black">Value</h4>
            <p>We value your time and money. We have a range of credit options to suit all budgets</p>
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
    <div class="row owl-carousel owl-theme owl-loaded owl-drag">
        <div class="col-12">
            <a href="https://player.vimeo.com/video/453378723" class="html5lightbox" title="Irish Sample Video">
                <img src="{{ asset('images/irish_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/453899480" class="html5lightbox" title="Geography Sample Video">
                <img src="{{ asset('images/geography_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/453091289" class="html5lightbox" title="Biology Sample Video">
                <img src="{{ asset('images/biology_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/465687118" class="html5lightbox" title="Accounting Sample Video">
                <img src="{{ asset('images/accounting_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/464263515" class="html5lightbox" title="Business Sample Video">
                <img src="{{ asset('images/business_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/453044427" class="html5lightbox" title="Construction Sample Video">
                <img src="{{ asset('images/construction_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/469312386" class="html5lightbox" title="Maths Sample Video">
                <img src="{{ asset('images/maths_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/464780279" class="html5lightbox" title="History Sample Video">
                <img src="{{ asset('images/history_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/465356070" class="html5lightbox" title="English Sample Video">
                <img src="{{ asset('images/english_sample.png') }}" class="img-fluid"></a>
        </div>
        <div class="col-12">
            <a href="https://player.vimeo.com/video/476327362" class="html5lightbox" title="Chemistry Sample Video">
                <img src="{{ asset('images/chemistry_sample.png') }}" class="img-fluid"></a>
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

<section class="container bg-pink rounded-lg mb-4">
    <div class="row d-flex align-items-center">
        <div class="col-12 col-md-9 text-white text-center p-2">
            <h2 class="main-heading display-5">Let's get started!</h2>
        </div>
        <div class="col-12 col-md-3 my-3">
            <a href="{{ route('register') }}" class="btn btn-light display-6 font-weight-bold text-uppercase d-block mx-auto shadow px-4 w-75">Sign Up Now!</a>
        </div>
    </div>

</section>
<section class="container mt-4">
    <div class="d-flex align-items-center">
        <div class="mx-auto">
            <p class="text-center display-6 font-weight-bold">All questions courtesy of <a href="https://educate.ie" target="_blank">educate.ie</a><br/>
            If you'd like to purchase exam papers mentioned in our videos click on the logo below</p>
            <a href="https://educate.ie" target="_blank">
            <img src="{{ asset('images/educate-logo.png') }}" class="mx-auto d-block" alt="educate logo" style="width:300px">
            </a>
        </div>
    </div>

</section>

@endsection

@section('bottom_scripts')
<script>
    $(document).ready(function(){
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            responsiveClass:true,
            responsive:{
                0:{
                    items:1,
                    nav:true
                },
                600:{
                    items:2,
                    nav:true
                },
                1000:{
                    items:3,
                    nav:true,
                    loop:true
                }
            }
        })
      });
</script>
@endsection
