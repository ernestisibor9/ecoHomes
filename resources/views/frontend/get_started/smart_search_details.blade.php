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
                <h1>Smart Search</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Smart Search Details</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-6 text-success" style="font-weight: bold">Smart Search Tool – </h1>
                <h1 class="display-6 mb-4 " style="font-weight: bold">Find Your Perfect Property in Seconds.</h1>
                <p class="text-dark" style="font-size: 1.1rem;">
                    Our Smart Search Tool is designed to make your property hunt faster, easier, and more personalized. With
                    advanced filtering options and intelligent algorithms, it ensures that you find the properties that
                    perfectly match your needs..
                </p>
                <p class="pb-2"></p>
                <p class="mt-4">
                    <a href="{{ route('book.search') }}" class="theme-btn btn-one">Book a Property Now!</a>
                </p>
            </div>
            <hr>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate6.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="mb-2 text-dark">
                    Our Smart Search Tools are your ultimate guide to finding the property that suits your needs
                    effortlessly. With advanced filtering options, you can narrow down your search and focus only on
                    listings that match your preferences.
                    Search by city, neighborhood, or proximity to landmarks.
                </p>
                <p class="mb-2 text-dark">
                    Our Smart Search Tools are your ultimate guide to finding the property that suits your needs
                    effortlessly. With advanced filtering options, you can narrow down your search and focus only on
                    listings that match your preferences.
                    Discover properties near schools, hospitals, or public transport.
                </p>
                <p class="text-dark">
                    Filter by square footage, number of bedrooms, or bathrooms. Perfect for families, singles, or business needs.
                    Look for specific features like swimming pools, gyms, parking, or gardens.
                </p>
                <div class="text-center mt-5">
                    <a href="{{ route('form.step1') }}" class="theme-btn btn-one">Click here to book a property</a>
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
