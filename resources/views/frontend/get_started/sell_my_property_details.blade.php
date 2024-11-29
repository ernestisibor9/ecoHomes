@extends('frontend.master')

@section('home')
    <style>
        .linear-property {
            background-color: #006633;
            height: 40vh;
            color: #ffffff;
        }
    </style>
        <style>
            /* Container to center and style the image */
            .image-container {
                display: inline-block;
                overflow: hidden; /* Ensures animation stays within bounds */
            }

            /* Style the image */
            .image-container img {
                display: block;
                height: auto;
                transition: transform 0.5s ease, filter 0.5s ease; /* Animation duration and easing */
            }

            /* Add hover effect */
            .image-container:hover img {
                transform: scale(1.1); /* Zooms in by 10% */
                filter: brightness(1.2); /* Increases brightness */
            }
        </style>

    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('form.step1') }}">
                <img src="{{ asset('frontend/assets/images/banner/sell_banner1.png') }}" alt="" class="img-fluid">
            </a>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-4 text-success" style="font-weight: bold">Sell Your Property</h1>
                <h1 class="display-4 mb-4 " style="font-weight: bold">Seamlessly Today!</h1>
                <p class="text-dark" style="font-size: 1.3rem;">
                    Join thousands of property owners and connect with
                </p>
                <p class="pb-2"></p>
                <p class="text-dark" style="font-size: 1.3rem;">ready buyers. Simple, fast, and secure.</p>
                <p class="mt-4">
                    <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Click here to sell your property</a>
                </p>
            </div>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/80223.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <img src="{{ asset('frontend/assets/images/banner/sell_fast.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <video autoplay muted loop class="w-100" style="height: auto; object-fit: cover;">
                    <source src="{{ asset('frontend/assets/videos/sell_video1.mp4') }}" type="video/mp4">
                </video>
            </div>
            <div class="col-md-6 d-flex flex-column gy-5">

                <h1 class="display-6 text-success" style="font-weight: bold">Sell Your Property</h1>
                <h1 class="display-6 mb-4 " style="font-weight: bold">Within 5 Days!</h1>
                <h2 class="display-6 mb-4" style="font-weight: bold">Fast, Easy, and Profitable!</h2>
                <p class="text-dark text-justify mt-2">
                    EcoHomes is here to transform your property-selling journey. No more long waiting times or
                    complicated processes. We specialize in connecting you with serious buyers and closing deals quickly.
                    Your property can be sold in just 5 days, with maximum profit and minimal effort!"
                </p>
                <p class="text-dark text-justify mt-2 mb-4">Ready to sell fast!</p>
                <div>
                    <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Click here to sell your property</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="text-center mt-5 mb-4" style="font-weight: bold;">Why Choose Us?</h1>
        <div class="row justify-content-center">
            <div class="col-md-4 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate4.jpg') }}" alt="" class="img-fluid">
                <h4 class="fw-bold text-dark text-center">Reach Millions</h4>
                <p class="text-dark text-center">Your property gets maximum exposure to thousands of potential buyers.</p>
                <div class="mt-2 text-center">
                    <a href="{{ route('reach.million.details') }}" class="theme-btn btn-one">Read more</a>
                </div>
            </div>
            <div class="col-md-4 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate3.png') }}" alt="" class="img-fluid">
                <h4 class="fw-bold text-dark text-center">Expert Support</h4>
                <p class="text-dark text-center">Our dedicated team assists you throughout the selling process.</p>
                <div class="mt-2 text-center">
                    <a href="{{ route('expert.solution.details') }}" class="theme-btn btn-one">Read more</a>
                </div>
            </div>
            <div class="col-md-4 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate2.jpg') }}" alt="" class="img-fluid">
                <h4 class="fw-bold text-dark text-center">Simple Process</h4>
                <p class="text-dark text-center">Enjoy a hassle-free selling experience with clear steps.</p>
                <div class="mt-2 text-center">
                    <a href="{{ route('simple.process.details') }}" class="theme-btn btn-one">Read more</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <img src="{{ asset('frontend/assets/images/banner/sell_banner2.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="linear-property text-center text-white p-4">
        <h1 class="text-white display-4">Ready to Sell Fast?</h1>
        <div>
            <p class="text-white display-6 mb-4" style="font-size: 1.3rem">List Your Property Now and Find the Right Buyer
                in Just 5 Days!</p>
            <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Click here to sell your property</a>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-4 text-success" style="font-weight: bold">Sell Your Property</h1>
                <h1 class="display-4 mb-4 " style="font-weight: bold">Seamlessly Today!</h1>
                <p class="text-dark" style="font-size: 1.3rem;">
                    Join thousands of property owners and connect with
                </p>
                <p class="pb-2"></p>
                <p class="text-dark" style="font-size: 1.3rem;">ready buyers. Simple, fast, and secure.</p>
                <p class="mt-4">
                    <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Click here to sell your property</a>
                </p>
            </div>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/80223.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
