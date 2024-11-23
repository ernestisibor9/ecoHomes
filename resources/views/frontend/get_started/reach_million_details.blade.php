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
            overflow: hidden;
            /* Ensures animation stays within bounds */
        }

        /* Style the image */
        .image-container img {
            display: block;
            height: auto;
            transition: transform 0.5s ease, filter 0.5s ease;
            /* Animation duration and easing */
        }

        /* Add hover effect */
        .image-container:hover img {
            transform: scale(1.1);
            /* Zooms in by 10% */
            filter: brightness(1.2);
            /* Increases brightness */
        }
    </style>

    <section class="page-title centred"
        style="background-image: url('{{ asset('frontend/assets/images/banner/banner_details.png') }}');">
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Reach Millions</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Reach Million Details</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-6 text-success" style="font-weight: bold">You Can Reach Out To</h1>
                <h1 class="display-6 mb-4 " style="font-weight: bold">Millions Of Potential</h1>
                <h2 class="display-6 mb-4 text-success" style="font-weight: bold">Buyers On Our Platform</h2>
                <p class="text-dark" style="font-size: 1.1rem;">
                    Join thousands of property owners and connect with
                </p>
                <p class="pb-2"></p>
                <p class="text-dark" style="font-size: 1.1rem;">ready buyers. Simple, fast, and secure.</p>
                <p class="mt-4">
                    <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Click here to sell your property</a>
                </p>
            </div>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/80223.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="mb-2 text-dark">
                    At EcoHomes, we understand that selling your property is one of the most significant
                    decisions you’ll make. That’s why we go beyond the ordinary to ensure your property gets the attention
                    it deserves by reaching millions of potential buyers globally.
                    globally.
                    We're committed to providing a safe, convenient, and transparent platform for property owners to
                    reach millions of potential buyers. We understand that selling your property can be a challenging
                    task, but we're here to help you achieve your goals.
                </p>
                <p class="mb-2 text-dark">
                    At EcoHomes, we are committed to turning your property into a sought-after listing that
                    attracts attention and offers. Let us help you sell your property with the power of maximum exposure,
                    strategic marketing, and a vast network of buyers.
                </p>
                <p class="text-dark">
                    If you're ready to start selling your property, we're here to help you achieve your goals. Let us
                    help you sell your property with the power of maximum exposure, strategic marketing, and a vast
                    network of buyers.
                </p>
                <div class="text-center mt-5">
                    <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Click here to sell your property</a>
                </div>
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
@endsection
