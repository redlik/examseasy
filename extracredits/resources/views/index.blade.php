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
            <h3 class="display-4 main-heading">Study your way</h3>
            <h2 class="display-2 main-heading">to success</h2>
            <p class="my-3">ExtraCredit is an online service trusted by thousands of second-level students and their
                parents across Ireland when preparing for exams. It is the modern alternative to grinds. <strong>Our unique credit system allows to only unlock the contact you need.</strong></p>

            <a href="{{ route('register') }}" class="btn btn-pink text-white p-3 my-4">SIGN-UP NOW</a>
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
            <p>We have started with over 200 lessons but our library will grow as we are adding new content regularly.</p>
        </div>
    </div>
</section>

<section class="container mt-4">
    <div class="row mb-4">
        <div class="col-12">
            <h2 class="main-heading text-center">
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
</section>

<!-- Section: Testimonials -->
<section class="text-center my-5 p-1">

    <!-- Section heading -->
    <h2 class="h1-responsive font-weight-bold my-5">Testimonials</h2>
    <!-- Section description -->
    <p class="dark-grey-text w-responsive mx-auto mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        Fugit, error amet numquam iure provident voluptate esse quasi, veritatis totam voluptas nostrum quisquam
        eum porro a pariatur veniam.</p>

    <!-- Grid row -->
    <div class="row">

        <!--Grid column-->
        <div class="col-lg-4 col-md-12 mb-lg-0 mb-4">
            <!--Card-->
            <div class="card testimonial-card">
                <!--Background color-->
                <div class="card-up info-color"></div>
                <!--Avatar-->
                <div class="avatar mx-auto white">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(9).jpg"
                        class="rounded-circle img-fluid">
                </div>
                <div class="card-body">
                    <!--Name-->
                    <h4 class="font-weight-bold mb-4">John Doe</h4>
                    <hr>
                    <!--Quotation-->
                    <p class="dark-grey-text mt-4"><i class="fas fa-quote-left pr-2"></i>Lorem ipsum dolor sit amet eos
                        adipisci, consectetur adipisicing elit.</p>
                </div>
            </div>
            <!--Card-->
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6 mb-md-0 mb-4">
            <!--Card-->
            <div class="card testimonial-card">
                <!--Background color-->
                <div class="card-up info-color">
                </div>
                <!--Avatar-->
                <div class="avatar mx-auto white">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(20).jpg"
                        class="rounded-circle img-fluid">
                </div>
                <div class="card-body">
                    <!--Name-->
                    <h4 class="font-weight-bold mb-4">Anna Aston</h4>
                    <hr>
                    <!--Quotation-->
                    <p class="dark-grey-text mt-4"><i class="fas fa-quote-left pr-2"></i>Neque cupiditate assumenda in
                        maiores repudiandae mollitia architecto.</p>
                </div>
            </div>
            <!--Card-->
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-lg-4 col-md-6">
            <!--Card-->
            <div class="card testimonial-card">
                <!--Background color-->
                <div class="card-up info-color"></div>
                <!--Avatar-->
                <div class="avatar mx-auto white">
                    <img src="https://mdbootstrap.com/img/Photos/Avatars/img%20(10).jpg"
                        class="rounded-circle img-fluid">
                </div>
                <div class="card-body">
                    <!--Name-->
                    <h4 class="font-weight-bold mb-4">Maria Kate</h4>
                    <hr>
                    <!--Quotation-->
                    <p class="dark-grey-text mt-4"><i class="fas fa-quote-left pr-2"></i>Delectus impedit saepe officiis
                        ab aliquam repellat rem unde ducimus.</p>
                </div>
            </div>
            <!--Card-->
        </div>
        <!--Grid column-->

    </div>
    <!-- Grid row -->

</section>
<!-- Section: Testimonials v.1 -->

@endsection
