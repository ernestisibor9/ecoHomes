@extends('frontend.master')

@section('home')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>


    <style>
        .property-img {
            width: 770px !important;
            height: 520px !important;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .spinner-border {
            vertical-align: middle;
            text-align: center;
        }
    </style>

    <!--Page Title-->

    <!-- property-details -->
    <section class="property-details property-details-one">
        <div class="auto-container">
            @if (session('message'))
                <div class="alert alert-{{ session('status') == 'success' ? 'success' : 'danger' }} alert-dismissible fade show"
                    role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="top-details clearfix">
                <div class="left-column pull-left clearfix">
                    <h3>
                        @if (isset($property))
                            {{ $property->property_name }}
                        @endif
                    </h3>
                    <div class="author-info clearfix">
                        <div class="author-box pull-left">
                            <figure class="author-thumb"><img
                                    src="{{ asset('frontend/assets/images/feature/author-1.jpg') }}" alt="">
                            </figure>
                            <h6>
                                @if (isset($property))
                                    Admin
                                @endif
                            </h6>
                        </div>
                        <ul class="rating clearfix pull-left">
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-40"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="right-column pull-right clearfix">
                    <div class="price-inner clearfix">
                        <ul class="category clearfix pull-left">
                            <li><a href="property-details.html" class="text-decoration-none">
                                    @if ($property->type->type_name === 'Hotel' || $property->type->type_name == 'Shortlet')
                                        Room {{ $property->room_number }}
                                    @else
                                        {{ $property->property_type->type_name }}
                                    @endif
                                </a>
                            </li>
                            <li><a href="property-details.html" class="text-decoration-none">
                                    @if (isset($property))
                                        @if ($property->type->type_name === 'Hotel' || $property->type->type_name == 'Shortlet')
                                            {{ $property->room_size }}
                                        @else
                                            {{ $property->property_status }} Now
                                        @endif
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="price-box pull-right">
                            <h3>
                                @if (isset($property))
                                    @if ($property->type->type_name == 'Hotel' || $property->type->type_name == 'Shortlet')
                                        @if ($currency == 'NGN')
                                            {{ '₦ ' . number_format($property->price_per_night, 2) }}
                                            <!-- Display price per night in NGN -->
                                        @else
                                            {{ $currency . ' ' . number_format($property->price_per_night_converted, 2) }}
                                            <!-- Display converted price per night -->
                                        @endif
                                    @else
                                        @if ($currency == 'NGN')
                                            {{ '₦ ' . number_format($property->price, 2) }}
                                            <!-- Display regular price in NGN -->
                                        @else
                                            {{ $currency . ' ' . number_format($property->price_converted, 2) }}
                                            <!-- Display converted regular price -->
                                        @endif
                                    @endif
                                @endif
                            </h3>
                        </div>
                    </div>
                    <ul class="other-option pull-right clearfix">
                        <li><a href="property-details.html"><i class="icon-37"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-38"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="row clearfix">
                <div class="toast align-items-center text-white position-fixed bottom-0 end-0 p-3" id="toast"
                    role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body"></div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                            aria-label="Close"></button>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-details-content">
                        <div class="carousel-inner">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                @if (isset($property))
                                    @foreach ($multiImage as $img)
                                        <figure class="image-box">
                                            <img src="{{ asset($img->photo_name) }}" alt="" class="property-img">
                                        </figure>
                                    @endforeach
                                @endif

                                @if (isset($sellProperty) && $sellProperty)
                                    <figure class="image-box">
                                        @php
                                            $images = is_array($sellProperty->multi_img)
                                                ? $sellProperty->multi_img
                                                : json_decode($sellProperty->multi_img, true); // Decode JSON if not already an array
                                        @endphp
                                        @if ($images)
                                            @foreach ($images as $img)
                                                <img src="{{ asset($img) }}" alt="Property Image" class="property-img">
                                            @endforeach
                                        @endif
                                    </figure>
                                @endif


                            </div>
                        </div>
                        <div class="discription-box content-widget">
                            <div class="title-box">
                                <h4>Property Description</h4>
                            </div>
                            <div class="text">
                                <p>
                                    @if (isset($property))
                                        {{ $property->long_description }}
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="details-box content-widget">
                            <div class="title-box">
                                <h4>Property Details</h4>
                            </div>
                            <ul class="list clearfix">
                                <li>Property ID: <span>
                                        @if (isset($property))
                                            For {{ $property->property_code }}
                                        @endif
                                    </span></li>
                                <li>Rooms: <span>06</span></li>
                                <li>Garage Size: <span>200 Sq Ft</span></li>
                                <li>Property Price: <span>
                                        @if (isset($property))
                                            ${{ $property->lowest_price }}
                                        @endif
                                    </span></li>
                                <li>Bedrooms: <span>
                                        @if (isset($property))
                                            {{ $property->bedrooms }}
                                        @endif
                                    </span></li>
                                <li>Year Built: <span>01 April, 2024</span></li>
                                <li>Property Type: <span>
                                        @if (isset($property))
                                            {{ $property->type->type_name }}
                                        @endif
                                    </span></li>
                                <li>Bathrooms: <span>
                                        @if (isset($property))
                                            {{ $property->bathrooms }}
                                        @endif
                                    </span></li>
                                <li>Property Status: <span>
                                        @if (isset($property))
                                            For {{ $property->property_status }}
                                        @endif
                                    </span></li>
                                </span>
                                </li>
                                <li>Property Size: <span>2024 Sq Ft</span></li>
                                <li>Garage: <span>01</span></li>
                            </ul>
                        </div>
                        <div class="amenities-box content-widget">
                            <div class="title-box">
                                <h4>Amenities</h4>
                            </div>
                            <ul class="list clearfix">
                                @if (!empty($property_amen))
                                    <ul>
                                        @foreach ($property_amen as $amenity)
                                            <li>{{ $amenity }} </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <li>No amenities listed.</li>
                                @endif
                            </ul>
                        </div>

                        <div class="location-box content-widget">
                            <div class="title-box">
                                <h4>Location</h4>
                            </div>
                            <ul class="info clearfix">
                                {{-- <li><span>Address:</span> Virginia temple hills</li> --}}
                                <li><span>Country:</span>
                                    @if (isset($property))
                                        {{ $property->country->name }}
                                    @endif
                                </li>
                                <li><span>State/County:</span>
                                    @if (isset($property))
                                        {{ $property->state->name }}
                                    @endif
                                </li>
                                <li><span>Zip/Postal Code:</span>23401</li>
                                <li><span>City:</span>
                                    @if (isset($property))
                                        {{ $property->city->name }}
                                    @endif
                                </li>
                            </ul>
                            <div class="google-map-area">
                                <div class="google-map" id="contact-google-map" data-map-lat="40.712776"
                                    data-map-lng="-74.005974" data-icon-path="assets/images/icons/map-marker.png"
                                    data-map-title="Brooklyn, New York, United Kingdom" data-map-zoom="12"
                                    data-markers='{
                                            "marker-1": [40.712776, -74.005974, "<h4>Branch Office</h4><p>77/99 New York</p>","assets/images/icons/map-marker.png"]
                                        }'>

                                </div>
                            </div>
                        </div>
                        <div class="nearby-box content-widget">
                            <div class="title-box">
                                <h4>What’s Nearby?</h4>
                            </div>
                            <div class="inner-box">
                                <div class="single-item">
                                    <div class="icon-box"><i class="fas fa-book-reader"></i></div>
                                    <div class="inner">
                                        <h5>Education:</h5>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>Western Reserve University <span>(2.10 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>Georgia Institute of Technology <span>(1.42 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>Harvey Mudd College <span>(2.10 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="fas fa-coffee"></i></div>
                                    <div class="inner">
                                        <h5>Restaurant:</h5>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>SC Ranch Market <span>(3.10 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>Chill On The Hill <span>(2.42 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>Gordon Ramsay Hell's Kitchen <span>(1.22 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-item">
                                    <div class="icon-box"><i class="fas fa-capsules"></i></div>
                                    <div class="inner">
                                        <h5>Health & Medical:</h5>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>North Star Medical Clinic <span> (2.10 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                        <div class="box clearfix">
                                            <div class="text pull-left">
                                                <h6>Clairvoyant Healing <span>(1.42 km)</span></h6>
                                            </div>
                                            <ul class="rating pull-right clearfix">
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-39"></i></li>
                                                <li><i class="icon-40"></i></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="statistics-box content-widget">
                            <div class="title-box">
                                <h4>Page Statistics</h4>
                            </div>
                            <figure class="image-box">
                                <a href="assets/images/resource/statistics-1.png" class="lightbox-image"
                                    data-fancybox="gallery"><img
                                        src="{{ asset('frontend/assets/images/resource/statistics-1.png') }}"
                                        alt=""></a>
                            </figure>
                        </div>
                        <div class="schedule-box content-widget">
                            <div class="title-box">
                                <h4>Schedule A Tour</h4>
                            </div>
                            <div class="form-inner">
                                <form action="property-details.html" method="post">
                                    <div class="row clearfix">
                                        <div class="col-lg-6 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="far fa-calendar-alt"></i>
                                                <input type="text" name="date" placeholder="Tour Date"
                                                    id="datepicker">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <i class="far fa-clock"></i>
                                                <input type="text" name="time" placeholder="Any Time">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="text" name="name" placeholder="Your Name"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="email" name="email" placeholder="Your Email"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <input type="tel" name="phone" placeholder="Your Phone"
                                                    required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group">
                                                <textarea name="message" placeholder="Your message"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 column">
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Submit Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="property-sidebar default-sidebar">
                        {{-- <div class="author-widget sidebar-widget">

                            <div class="form-inner">
                                <form action="property-details.html" method="post" class="default-form">
                                    <div class="form-group">
                                        <input type="text" name="name" placeholder="Your name" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="Your Email" required="">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="phone" placeholder="Phone" required="">
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" placeholder="Message"></textarea>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" class="theme-btn btn-one">Send Message</button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}
                        <div class="calculator-widget sidebar-widget">
                            <div class="calculate-inner">
                                <div class="widget-title">
                                    <h4 style="color: green">
                                        @if (isset($property))
                                            @if ($property->type->type_name == 'Hotel' || $property->type->type_name == 'Shortlet')
                                                @if ($currency == 'NGN')
                                                    {{ '₦ ' . number_format($property->price_per_night, 2) }} <small
                                                        style="font-size: 0.9rem; color: gray;">Per Night</small>
                                                    <!-- Display price per night in NGN -->
                                                @else
                                                    {{ $currency . ' ' . number_format($property->price_per_night_converted, 2) }}
                                                    <small style="font-size: 0.9rem; color: gray;">Per Night</small>
                                                    <!-- Display converted price per night -->
                                                @endif
                                            @else
                                                @if ($currency == 'NGN')
                                                    {{ '₦ ' . number_format($property->price, 2) }} <small
                                                        style="font-size: 0.9rem; color: gray;">Per Night</small>
                                                    <!-- Display regular price in NGN -->
                                                @else
                                                    {{ $currency . ' ' . number_format($property->price_converted, 2) }}
                                                    <small style="font-size: 0.9rem; color: gray;">Per Night</small>
                                                    <!-- Display converted regular price -->
                                                @endif
                                            @endif
                                        @endif
                                    </h4>
                                    {{-- $<h4 id="basePrice"> <span>Night</span></h4> --}}
                                </div>
                                <form method="post" action="" class="default-form" id="bookingForm">
                                    @csrf
                                    <input type="hidden" name="property_id" id="roomId"
                                        value="{{ $property->id }}">
                                    <input type="hidden" name="property_name" id="roomName"
                                        value="{{ $property->property_name }}">
                                    <small>Check In</small>
                                    <div class="form-group">
                                        <i class="fas fa-calendar"></i>
                                        <input type="date" id="check_in" name="check_in" class="form-control"
                                            required placeholder="YYYY-MM-DD" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <small>Check Out</small>
                                    <div class="form-group">
                                        <i class="fas fa-calendar"></i>
                                        <input type="date" id="check_out" name="check_out" class="form-control"
                                            required placeholder="YYYY-MM-DD" min="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <small>Adults</small>
                                    <div class="form-group">
                                        <i class="fas fa-user"></i>
                                        <input type="number" id="guest_adults" name="guest_adults" value="1"
                                            min="1">
                                    </div>
                                    <small>Children</small>
                                    <div class="form-group">
                                        <i class="fas fa-user"></i>
                                        <input type="number" id="guest_children" name="guest_children" value="0"
                                            min="0">
                                    </div>
                                    <small>Pets</small>
                                    <div class="form-group">
                                        <i class="fas fa-dog"></i>
                                        <input type="number" name="guest_pets" value="0" min="0">
                                    </div>
                                    <div>
                                        <div id="errorMessage" class="text-danger mb-3"></div>
                                    </div>
                                    <div>
                                        <p id="availabilityMessage"></p>
                                    </div>
                                    <div id="priceDetails" class="mt-4" style="display: none;">
                                        <h5>Price Details</h5>
                                        <p><strong>Total Nights:</strong> <span id="totalNights"></span></p>
                                        <p><strong>Base Price:</strong> <span id="basePrice"></span></p>
                                        {{-- <p><strong>Cleaning Fee:</strong> <span id="cleaningFee"></span></p> --}}
                                        <p><strong>Eco Home Service Fee:</strong> <span id="ecoFee"></span></p>
                                        <p><strong>Total Price:</strong> <span id="totalPrice"></span></p>
                                    </div>
                                    <div class="form-group message-btn">
                                        <button type="submit" id="availabilityButton" class="theme-btn btn-one">Check
                                            Availability</button>
                                    </div>

                                </form>
                            </div>


                        </div>
                        <div class="calculator-widget sidebar-widget" id="ad-container">
                            <h2>ADVERTISEMENT</h2>
                            <!-- Initial Ad Placeholder -->
                            <img src="{{ asset('frontend/assets/images/adverts/ad1.jpg') }}" alt="Ad 1"
                                class="img-fluid" id="current-ad">
                        </div>
                    </div>
                </div>
            </div>
            <div class="similar-content">
                <div class="title">
                    <h4>Similar Properties</h4>
                </div>
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms"
                            data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img
                                            src="{{ asset('frontend/assets/images/feature/feature-1.jpg') }}"
                                            alt=""></figure>
                                    <div class="batch"><i class="icon-11"></i></div>
                                    <span class="category">Featured</span>
                                </div>
                                <div class="lower-content">
                                    <div class="author-info clearfix">
                                        <div class="author pull-left">
                                            <figure class="author-thumb"><img
                                                    src="{{ asset('frontend/assets/images/feature/author-1.jpg') }}"
                                                    alt=""></figure>
                                            <h6>Michael Bean</h6>
                                        </div>
                                        <div class="buy-btn pull-right"><a href="property-details.html">For Buy</a></div>
                                    </div>
                                    <div class="title-text">
                                        <h4><a href="property-details.html">Villa on Grand Avenue</a></h4>
                                    </div>
                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6>Start From</h6>
                                            <h4>
                                                @if (isset($property))
                                                    ${{ $property->lowest_price }}
                                                @endif

                                                @if (isset($sellProperty))
                                                    ${{ $sellProperty->lowest_price }}
                                                @endif
                                            </h4>
                                        </div>
                                        <ul class="other-option pull-right clearfix">
                                            <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                            <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                    <ul class="more-details clearfix">
                                        <li><i class="icon-14"></i>3 Beds</li>
                                        <li><i class="icon-15"></i>2 Baths</li>
                                        <li><i class="icon-16"></i>600 Sq Ft</li>
                                    </ul>
                                    <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See
                                            Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="300ms"
                            data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img
                                            src="{{ asset('frontend/assets/images/feature/feature-2.jpg') }}"
                                            alt=""></figure>
                                    <div class="batch"><i class="icon-11"></i></div>
                                    <span class="category">Featured</span>
                                </div>
                                <div class="lower-content">
                                    <div class="author-info clearfix">
                                        <div class="author pull-left">
                                            <figure class="author-thumb"><img
                                                    src="{{ asset('frontend/assets/images/feature/author-2.jpg') }}"
                                                    alt=""></figure>
                                            <h6>Robert Niro</h6>
                                        </div>
                                        <div class="buy-btn pull-right"><a href="property-details.html">For Rent</a></div>
                                    </div>
                                    <div class="title-text">
                                        <h4><a href="property-details.html">Contemporary Apartment</a></h4>
                                    </div>
                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6>Start From</h6>
                                            <h4>$45,000.00</h4>
                                        </div>
                                        <ul class="other-option pull-right clearfix">
                                            <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                            <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                    <ul class="more-details clearfix">
                                        <li><i class="icon-14"></i>3 Beds</li>
                                        <li><i class="icon-15"></i>2 Baths</li>
                                        <li><i class="icon-16"></i>600 Sq Ft</li>
                                    </ul>
                                    <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See
                                            Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="600ms"
                            data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image"><img
                                            src="{{ asset('frontend/assets/images/feature/feature-3.jpg') }}"
                                            alt=""></figure>
                                    <div class="batch"><i class="icon-11"></i></div>
                                    <span class="category">Featured</span>
                                </div>
                                <div class="lower-content">
                                    <div class="author-info clearfix">
                                        <div class="author pull-left">
                                            <figure class="author-thumb"><img
                                                    src="{{ asset('frontend/assets/images/feature/author-3.jpg') }}"
                                                    alt=""></figure>
                                            <h6>Keira Mel</h6>
                                        </div>
                                        <div class="buy-btn pull-right"><a href="property-details.html">Sold Out</a></div>
                                    </div>
                                    <div class="title-text">
                                        <h4><a href="property-details.html">Luxury Villa With Pool</a></h4>
                                    </div>
                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6>Start From</h6>
                                            <h4>$63,000.00</h4>
                                        </div>
                                        <ul class="other-option pull-right clearfix">
                                            <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                            <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                        </ul>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet consectetur adipisicing sed.</p>
                                    <ul class="more-details clearfix">
                                        <li><i class="icon-14"></i>3 Beds</li>
                                        <li><i class="icon-15"></i>2 Baths</li>
                                        <li><i class="icon-16"></i>600 Sq Ft</li>
                                    </ul>
                                    <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See
                                            Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- property-details end -->


    <!-- Modal for User Type Selection -->
    <div class="modal fade" id="userTypeModal" tabindex="-1" aria-labelledby="userTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userTypeModalLabel">Continue as</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Choose how you want to proceed:</p>
                    <div id="userTypeOptions" class="d-flex justify-content-between">
                        <button id="guestUserButton" class="btn btn-primary">Guest User</button>
                        <button id="regularUserButton" class="btn btn-secondary">Regular User</button>
                    </div>

                    <!-- Hidden email input field for Guest User -->
                    <div id="guestEmailInput" class="mt-3" style="display: none;">
                        <label for="guestEmail" class="form-label">Enter your email to receive an OTP:</label>
                        <p id="invalid_email" class="text-danger"></p>
                        <input type="email" id="guestEmail" class="form-control" placeholder="Enter your email"
                            required>
                            <div class="mt-3 mb-3">
                                <span id="spinner" class="spinner-border spinner-border-sm text-success me-2" style="display: none;"></span>
                            </div>
                        <button id="sendOtpButton" class="btn btn-success mt-2">
                            Send OTP
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script>
        // Get the current date
        const now = new Date();

        // Format date as YYYY-MM-DD
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');

        const currentDate = `${year}-${month}-${day}`;

        // Set the min attribute for the input field
        document.getElementById('requested_date').setAttribute('min', currentDate);
    </script>

    <script>
        // Array of ads with custom durations (in milliseconds)
        const ads = [{
                img: '{{ asset('frontend/assets/images/adverts/ad1.jpg') }}',
                link: 'https://example.com/ad1',
                duration: 30000
            }, // 1 minute
            {
                img: '{{ asset('frontend/assets/images/adverts/ad2.jpg') }}',
                link: 'https://example.com/ad2',
                duration: 30000
            }, // 1 minutes
            {
                img: '{{ asset('frontend/assets/images/adverts/ad3.jpg') }}',
                link: 'https://example.com/ad3',
                duration: 30000
            } // 1 minutes
        ];

        let currentAdIndex = 0; // Track the current ad index

        // Function to display the next ad
        function showNextAd() {
            // Get the current ad
            const currentAd = ads[currentAdIndex];

            // Update the ad container
            const adContainer = document.getElementById('ad-container');
            adContainer.innerHTML = `
            <a href="${currentAd.link}" target="_blank">
                <img src="${currentAd.img}" alt="Ad ${currentAdIndex + 1}" style="width: 100%; height: 100%;">
            </a>
        `;

            // Set a timeout for the next ad
            setTimeout(() => {
                // Move to the next ad (loop back if at the end)
                currentAdIndex = (currentAdIndex + 1) % ads.length;
                showNextAd(); // Recursively show the next ad
            }, currentAd.duration);
        }

        // Start displaying ads
        showNextAd();
    </script>


    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        document.getElementById('bookingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const priceDetailsElement = document.getElementById('priceDetails');
            const messageElement = document.getElementById('availabilityMessage');
            const errorMessage = document.getElementById('errorMessage');
            const availabilityButton = document.getElementById('availabilityButton'); // Reference to the button

            // Reset previous messages
            messageElement.textContent = '';
            errorMessage.textContent = '';
            priceDetailsElement.style.display = 'none';

            // Send availability check
            fetch('/check-availability', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                    },
                    body: formData,
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to check availability. Please try again.');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.available) {
                        // messageElement.textContent = 'The room is available for the selected dates.';
                        messageElement.style.color = 'green';

                        // Change button text to "Reserve"
                        availabilityButton.textContent = 'Reserve';

                        // Fetch price details
                        return fetch('/calculate-price', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });
                    } else {
                        messageElement.textContent = 'Sorry, the room is not available for the selected dates.';
                        messageElement.style.color = 'red';

                        // Reset button text if not available
                        availabilityButton.textContent = 'Check Availability';
                        throw new Error('Room not available.');
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to calculate price. Please try again.');
                    }
                    return response.json();
                })
                .then(priceData => {
                    // Extract currency from response
                    const currency = priceData.currency;

                    // Populate price details
                    document.getElementById('totalNights').textContent = priceData.days;
                    document.getElementById('basePrice').textContent =
                        `${currency} ${Number(priceData.base_price).toFixed(2)}`;
                    // document.getElementById('cleaningFee').textContent =
                    //     `${currency} ${Number(priceData.cleaning_fee).toFixed(2)}`;
                    document.getElementById('ecoFee').textContent =
                        `${currency} ${Number(priceData.eco_home_service_fee).toFixed(2)}`;
                    document.getElementById('totalPrice').textContent =
                        `${currency} ${Number(priceData.total_price).toFixed(2)}`;
                    priceDetailsElement.style.display = 'block';
                })
                .catch(error => {
                    console.error(error);
                    errorMessage.textContent = error.message ||
                        'An unexpected error occurred. Please try again.';
                });
        });
    </script>

    <script>
        document.getElementById('availabilityButton').addEventListener('click', function(e) {
            if (this.textContent === 'Reserve') {
                e.preventDefault();
                $('#userTypeModal').modal('show'); // Show the modal
            }
        });

        // Show Guest User Email Input
        document.getElementById('guestUserButton').addEventListener('click', function() {
            document.getElementById('userTypeOptions').style.display = 'none';
            document.getElementById('guestEmailInput').style.display = 'block';
        });

        // Toast Function
        function showToast(type, message) {
            const toastEl = document.getElementById('toast');
            const toastBody = toastEl.querySelector('.toast-body');

            toastBody.textContent = message; // Set the toast message
            toastEl.classList.remove('bg-success', 'bg-danger');
            toastEl.classList.add(type === 'success' ? 'bg-success' : 'bg-danger');
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }

        // Handle Send OTP Button Click
        document.getElementById('sendOtpButton').addEventListener('click', function() {
            const guestEmail = document.getElementById('guestEmail').value.trim();
            document.getElementById('spinner').style.display = 'block';


            // Validate email
            if (!guestEmail || !validateEmail(guestEmail)) {
                const invalidEmail = document.getElementById('invalid_email')
                invalidEmail.style.display = 'block';
                invalidEmail.style.textAlign = 'center';
                invalidEmail.textContent = "Please enter a valid email address"
                showToast('danger', 'Please enter a valid email address.');
                document.getElementById('spinner').style.display = 'none';
                return;
            }

            // Send OTP to Guest User Email
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            fetch('/send-guest-otp', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        email: guestEmail
                    }),
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to send OTP. Please try again.');
                        document.getElementById('spinner').style.display = 'none';
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showToast('success', 'OTP sent to your email. Please verify to proceed.');
                        setTimeout(() => {
                            window.location.href =
                                `/verify-otp?email=${encodeURIComponent(data.email)}`;
                        }, 2000);
                        document.getElementById('spinner').style.display = 'none';
                    } else {
                        throw new Error(data.message || 'An error occurred.');
                        document.getElementById('spinner').style.display = 'none';
                    }
                })
                .catch(error => {
                    showToast('danger', error.message || 'An unexpected error occurred.');
                    document.getElementById('spinner').style.display = 'none';
                });

        });

        // Email Validation Function
        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }
    </script>


    <script>
        document.getElementById('regularUserButton').addEventListener('click', function(e) {
            e.preventDefault();

            // Extract totalPrice and roomId
            const totalPriceElement = document.getElementById('totalPrice');
            const roomIdElement = document.getElementById('roomName');

            const totalPrice = totalPriceElement ? totalPriceElement.textContent.trim() : null;
            const roomName = roomIdElement ? roomIdElement.value : null;

            if (totalPrice && roomId) {
                // Redirect to the payment page with query parameters
                const paymentUrl =
                    `/regular/user?totalPrice=${encodeURIComponent(totalPrice)}&roomName=${encodeURIComponent(roomName)}`;
                window.location.href = paymentUrl;
            } else {
                alert('Error: Missing total price or room information.');
            }
        });
    </script>


@endsection
