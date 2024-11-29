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
                <h1>Unmatched Variety </h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Unmatched Variety Details</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-6 text-success" style="font-weight: bold">Unmatched Variety –</h1>
                <h1 class="display-6 mb-4 " style="font-weight: bold">A Property for Every Dream</h1>
                <p class="text-dark" style="font-size: 1.1rem;">
                    Finding the perfect property should be as unique as your needs, and that’s why we offer an unparalleled
                    selection of properties to suit every lifestyle, budget, and vision..
                </p>
                <p class="pb-2"></p>
                <p class="mt-4">
                    <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Book a Property Now!</a>
                </p>
            </div>
            <hr>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate7.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="mb-2 text-dark">
                    Whether you're a young professional, or a small family, our cozy and affordable apartments
                    offer comfort and convenience.
                    From retail shops to corporate offices, find the perfect space to grow your business.
                </p>
                <p class="mb-2 text-dark">
                    Need more space? Choose from modern, well-equipped houses designed for family living in prime
                    neighborhoods.
                    Elevate your lifestyle with stunning properties featuring breathtaking views, pools, and
                    state-of-the-art amenities.
                </p>
                <p class="text-dark">
                    From retail shops to corporate offices, find the perfect space to grow your business.
                </p>
                <div class="text-center mt-5">
                    <a href="{{ route('book.search') }}" class="theme-btn btn-one">Click here to book a property</a>
                </div>
            </div>
        </div>
    </div>
    <div class="linear-property text-center text-white p-4">
        <h1 class="text-white display-4 mb-2">Ready to Book Now?</h1>
        <div>
            <p class="text-white display-6 mb-4" style="font-size: 1.3rem">Click below to find and
                book your dream property now!</p>
            <a href="{{ route('book.search') }}" class="theme-btn btn-one">Book a Property Now</a>
        </div>
    </div>
@endsection
