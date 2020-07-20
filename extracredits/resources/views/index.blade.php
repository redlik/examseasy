@extends('layouts.app')

@section('content')
<div class="col-md-6 col-sm-12">
    <div class="d-flex align-content-center">
        <div class="py-3">
            <h3 class="display-4">Study your way</h3>
            <h2 class="display-2">to success</h2>
            <p class="my-3">ExtraCredit is an online service trusted by thousands of second-level students and their
                parents across
                Ireland when preparing for exams. It is the modern alternative to grinds.</p>
            <a href="{{ route('register') }}" class="btn btn-danger my-4">SIGN-UP NOW</a>
        </div>

    </div>
</div>
<div class="col-md-6 col-sm-12">
    <img src="{{ asset('images/home-hero.svg') }}" alt="extra credit home page">
</div>

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
