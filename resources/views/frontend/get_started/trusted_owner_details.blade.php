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
                <h1>Trusted Owner</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Trusted Owner Details</li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-6 text-success" style="font-weight: bold">Trusted Agents & Owners:</h1>
                <h1 class="display-6 mb-4 " style="font-weight: bold">Your Confidence, Our Priority.</h1>
                <p class="text-dark" style="font-size: 1.1rem;">
                    Booking a property is a significant decision, and we understand how important trust is in the process.
                    That's why our platform prioritizes connecting you with verified and reliable agents and property
                    owners.
                </p>
                <p class="pb-2"></p>
                <p class="mt-4">
                    <a href="{{ route('book.search') }}" class="theme-btn btn-one">Book a Property Now!</a>
                </p>
            </div>
            <hr>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/80223.jpg') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="mb-2 text-dark">
                    At EcoHomes, we explore a diverse collection of properties, including residential, commercial, and
                    luxury listings, tailored to suit your preferences. Whether you're looking for a cozy apartment, a
                    spacious house, or a prime office space, we’ve got you covered.
                    Stay up-to-date with real-time property availability, ensuring you never miss out on your ideal listing.
                </p>
                <p class="mb-2 text-dark">
                    Our Book a Property feature is designed to provide a seamless and hassle-free experience for anyone
                    looking to secure their dream home or investment property. With a user-friendly interface and advanced
                    features, finding and booking your ideal property has never been easier.
                    Our platform ensures a safe and secure booking process, protecting your data and transactions.
                </p>
                <p class="text-dark">
                    Ready to take the first step toward your dream property? Explore our listings, book your property, and
                    start a new chapter in your life.
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
