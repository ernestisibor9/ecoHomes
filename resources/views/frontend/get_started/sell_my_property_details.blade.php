@extends('frontend.master')

@section('home')
    <style>
        .linear-property {
            background-color: #006633;
            height: 40vh;
            color: #ffffff;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('sell.my.property') }}">
                <img src="{{ asset('frontend/assets/images/banner/sell_banner1.png') }}" alt="" class="img-fluid">
            </a>
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
                <h2 class="text-center fw-bold" style="text-align: center"><span style="font-weight: bold"> Sell Your
                        Property Within 5 Days </span>– Fast, Easy, and Profitable!
                </h2>
                <p class="mt-4 text-dark text-justify">
                    Tired of waiting months to sell your property? With our 5-Day Selling Program, your property gets the
                    attention it deserves, fast! Our expert marketing strategies, buyer network, and dedicated support make
                    closing deals quicker than ever
                </p>
                <p class="text-dark text-justify mt-2">
                    EcoHomes is here to transform your property-selling journey. No more long waiting times or
                    complicated processes. We specialize in connecting you with serious buyers and closing deals quickly.
                    Your property can be sold in just 5 days, with maximum profit and minimal effort!"
                </p>
                <p class="text-dark text-justify mt-2 mb-2">Ready to sell fast!</p>
                <div>
                    <a href="{{ route('sell.my.property') }}" class="theme-btn btn-one">Click here to sell your property</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
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
            <a href="{{ route('sell.my.property') }}" class="theme-btn btn-one">Click here to sell your property</a>
        </div>
    </div>
@endsection
