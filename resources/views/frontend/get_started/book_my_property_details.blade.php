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

    <div class="container-fluid">
        <div class="row">
            <a href="{{ route('list.all.property') }}">
                <img src="{{ asset('frontend/assets/images/banner/buy_banner.png') }}" alt="" class="img-fluid">
            </a>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-4 text-success" style="font-weight: bold">Book A Property</h1>
                <h1 class="display-4 mb-4 " style="font-weight: bold">Your Gateway to Dream Living!</h1>
                <p class="text-dark" style="font-size: 1.3rem;">
                    We provide a seamless and hassle-free experience for anyone looking to secure their dream home or
                    investment property.
                </p>
                <p class="pb-2"></p>
                {{-- <p class="text-dark" style="font-size: 1.3rem;">ready buyers. Simple, fast, and secure.</p> --}}
                <p class="mt-4">
                    <a href="{{ route('list.all.property') }}" class="theme-btn btn-one">Click here to book a property</a>
                </p>
            </div>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate5.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <img src="{{ asset('frontend/assets/images/banner/buy_banner2.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('frontend/assets/images/banner/buy_flyer.jpg') }}" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 d-flex flex-column gy-5">

                <h1 class="display-4 text-success" style="font-weight: bold">Find Your Dream Property Today </h1>
                <h1 class="display-6 mb-4 " style="font-weight: bold">– Hassle-Free Booking Awaits!</h1>
                <p class="text-dark text-justify mt-2">
                    Our Book a Property feature is designed to provide a seamless and hassle-free experience for anyone
                    looking to secure their dream home or investment property. With a user-friendly interface and advanced
                    features, finding and booking your ideal property has never been easier.
                </p>
                <p class="text-dark text-justify mt-2 mb-4">
                    Explore a diverse collection of properties, including residential, commercial, and luxury listings,
                    tailored to suit your preferences. Whether you're looking for a cozy apartment, a spacious house, or a
                    prime office space, we’ve got you covered.
                </p>
                <div>
                    <a href="{{ route('list.all.property') }}" class="theme-btn btn-one">Click here to book a property</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <h1 class="text-center mt-5 mb-4" style="font-weight: bold;">Why Book Your Property with Us?</h1>
        <div class="row justify-content-center">
            <div class="col-md-4 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate4.jpg') }}" alt="" class="img-fluid">
                <h4 class="fw-bold text-dark text-center">Trusted Owners</h4>
                <p class="text-dark text-center">Book confidently knowing you’re dealing with verified professionals.</p>
                <div class="mt-2 text-center">
                    <a href="{{ route('trusted.owner.details') }}" class="theme-btn btn-one">Read more</a>
                </div>
            </div>
            <div class="col-md-4 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate7.jpg') }}" alt="" class="img-fluid">
                <h4 class="fw-bold text-dark text-center">Unmatched Variety</h4>
                <p class="text-dark text-center">From cozy apartments to sprawling mansions, we have it all.</p>
                <div class="mt-2 text-center">
                    <a href="{{ route('unmatched.variety.details') }}" class="theme-btn btn-one">Read more</a>
                </div>
            </div>
            <div class="col-md-4 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate6.jpg') }}" alt="" class="img-fluid">
                <h4 class="fw-bold text-dark text-center">Smart Search Tools</h4>
                <p class="text-dark text-center">Filter by location, price, size, and more to find your perfect match</p>
                <div class="mt-2 text-center">
                    <a href="{{ route('smart.search.details') }}" class="theme-btn btn-one">Read more</a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 mb-5">
        <div class="row">
            <a href="{{ route('list.all.property') }}">
                <img src="{{ asset('frontend/assets/images/banner/buy_banner.png') }}" alt="" class="img-fluid">
            </a>
        </div>
    </div>
    <div class="linear-property text-center text-white p-4">
        <h1 class="text-white display-4 mb-2">Ready to Book Now?</h1>
        <div>
            <p class="text-white display-6 mb-4" style="font-size: 1.3rem">Click below to find and
                book your dream property now!</p>
            <a href="{{ route('list.all.property') }}" class="theme-btn btn-one">Book a Property Now</a>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-4 text-success" style="font-weight: bold">Book A Property</h1>
                <h1 class="display-4 mb-4 " style="font-weight: bold">Your Gateway to Dream Living!</h1>
                <p class="text-dark" style="font-size: 1.3rem;">
                    We provide a seamless and hassle-free experience for anyone looking to secure their dream home or
                    investment property.
                </p>
                <p class="pb-2"></p>
                {{-- <p class="text-dark" style="font-size: 1.3rem;">ready buyers. Simple, fast, and secure.</p> --}}
                <p class="mt-4">
                    <a href="{{ route('list.all.property') }}" class="theme-btn btn-one">Click here to book a property</a>
                </p>
            </div>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate5.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
