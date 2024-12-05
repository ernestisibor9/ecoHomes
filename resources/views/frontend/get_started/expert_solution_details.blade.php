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
                <h1>Expert Support</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Expert Support Details</li>
                </ul>
            </div>
        </div>
    </section>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="display-6 text-success" style="font-weight: bold">Connect With Our Experts</h1>
                <h2 class="display-6 mb-4 " style="font-weight: bold">Get Step-By-Step Guidance</h2>
                <h2 class="display-6 mb-4 text-success" style="font-weight: bold">Throughout The Entire Process,</h2>
                <p class="text-dark" style="font-size: 1.1rem;">
                    Whether you're buying, selling, or renting, our team provides customized
                </p>
                <p class="pb-2"></p>
                <p class="text-dark" style="font-size: 1.1rem;">advice based on your preferences, budget, and goals.</p>
                <p class="mt-4">
                    <button id="activateChatbot" class="theme-btn btn-one">Connect to our expert</button>
                </p>
            </div>
            <div class="col-md-6 image-container">
                <img src="{{ asset('frontend/assets/images/animate/animate3.png') }}" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <p class="mb-2 text-dark">
                    At EcoHomes, we understand that navigating the real estate market can be complex and
                    challenging. That’s why we offer Expert Solutions tailored to meet your unique property needs.
                    Whether you're buying, selling, or renting, our team provides customized advice based on your
                    preferences, budget, and goals.
                </p>
                <p class="mb-2 text-dark">
                    With our professional expertise and cutting-edge technology, we aim to simplify the property journey,
                    delivering exceptional results and ensuring peace of mind.
                </p>
                <p class="text-dark">
                    Ready to find your dream property or sell your current one? Let our Expert Solutions turn your vision
                    into reality.
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

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      document.getElementById("activateChatbot").addEventListener("click", function () {
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/674c11462480f5b4f5a6570f/1ie0i6vqs';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    });
    </script>
    <!--End of Tawk.to Script-->
@endsection
