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

        .property-icon i {
            color: #2DBE6C;
        }
    </style>

    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>

    <!--Page Title-->
    {{-- <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url(assets/images/shape/shape-9.png);"></div>
            <div class="pattern-2" style="background-image: url(assets/images/shape/shape-10.png);"></div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Property Details</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Property Details</li>
                </ul>
            </div>
        </div>
    </section> --}}
    <!--End Page Title-->


    <!-- property-details -->
    <section class="property-details property-details-one">
        <div class="auto-container">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="top-details clearfix">
                <div class="left-column pull-left clearfix">
                    <h3 style="color: #2DBE6C;">
                        @if (isset($property))
                            {{ $property->property_title }}
                        @endif
                    </h3>
                    <div class="author-info clearfix">
                        <div class="author-box pull-left">
                            <figure class="author-thumb"><img
                                    src="{{ asset('frontend/assets/images/feature/author-1.jpg') }}" alt="">
                            </figure>
                            @if (isset($property))
                                <h4>{{ $property->property_variant }} for {{ $property->property_status }}</h4>
                                <div class="property-icon"><i class="fa fa-map-marker-alt"></i>&nbsp;&nbsp; <span
                                        class="text-danger">{{ $property->city_id ? $property->city->name : '' }},&nbsp;{{ $property->state->name }},&nbsp;{{ $property->country->name }}</span>
                                </div>
                            @endif
                        </div>
                        {{-- <ul class="rating clearfix pull-left">
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-39"></i></li>
                            <li><i class="icon-40"></i></li>
                        </ul> --}}
                    </div>
                </div>
                <div class="right-column pull-right clearfix">
                    <div class="price-inner clearfix">
                        <ul class="category clearfix pull-left">
                            <li><a href="#" class="text-decoration-none">
                                    @if (isset($property))
                                        {{ $property->property_variant }}
                                    @endif
                                </a>
                            </li>
                            <li><a href="#" class="text-decoration-none">
                                    @if (isset($property))
                                        {{ $property->property_status }} Now
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="price-box pull-right">
                            <h3>
                                @if (isset($property))
                                    @if ($currency == 'NGN')
                                        {{ '₦ ' . number_format($property->price, 2) }} <small
                                            style="font-size: 0.9rem; color: gray;">{{ $property->season }}</small>
                                        <!-- Display price per night in NGN -->
                                    @else
                                        {{ $currency . ' ' . number_format($property->price_converted, 2) }}
                                        <small style="font-size: 0.9rem; color: gray;">{{ $property->season }}</small>
                                        <!-- Display converted price per night -->
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
                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-details-content">
                        <div class="carousel-inner">
                            <div class="single-item-carousel owl-carousel owl-theme owl-dots-none">
                                @if (isset($property))
                                    @foreach ($multiImage as $img)
                                        <figure class="image-box">
                                            <img src="{{ asset($img->multi_photo_name) }}" alt=""
                                                class="property-img">
                                        </figure>
                                    @endforeach
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
                                        {{ $property->description }}
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
                                            ${{ $property->price }}
                                        @endif
                                    </span></li>
                                <li>Bedrooms: <span>
                                        @if (isset($property))
                                            {{ $property->bedroom }}
                                        @endif
                                    </span></li>
                                <li>Year Built: <span>01 April, 2024</span></li>
                                <li>Property Type: <span>
                                        @if (isset($property))
                                            {{ $property->property_variant }}
                                        @endif
                                    </span></li>
                                <li>Bathrooms: <span>
                                        @if (isset($property))
                                            {{ $property->bathroom }}
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
                                {{-- @if (!empty($property_amen))
                                    <ul>
                                        @foreach ($property_amen as $amenity)
                                            <li>{{ $amenity }} </li>
                                        @endforeach
                                    </ul>
                                @else
                                    <li>No amenities listed.</li>
                                @endif --}}
                                <p>
                                    @if (!empty($guest_facilities))
                                    @foreach ($guest_facilities as $amenity)
                                        <li>{{ $amenity }}</li>
                                    @endforeach
                                @else
                                    <p>No amenities listed...</p>
                                @endif
                                </p>
                            </ul>
                        </div>
                        <div id="map"></div>
                        {{-- <div class="floorplan-inner content-widget">
                            <div class="title-box">
                                <h4>Floor Plan</h4>
                            </div>
                            <ul class="accordion-box">
                                <li class="accordion block active-block">
                                    <div class="acc-btn active">
                                        <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                        <h5>First Floor</h5>
                                    </div>
                                    <div class="acc-content current">
                                        <div class="content-box">
                                            <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia
                                                deserunt mollit anim est laborum. Sed perspiciatis unde omnis iste natus
                                                error sit voluptatem accusa dolore mque laudant.</p>
                                            <figure class="image-box">
                                                <img src="{{ asset('frontend/assets/images/resource/floor-1.png') }}"
                                                    alt="">
                                            </figure>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                        <h5>Second Floor</h5>
                                    </div>
                                    <div class="acc-content">
                                        <div class="content-box">
                                            <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia
                                                deserunt mollit anim est laborum. Sed perspiciatis unde omnis iste natus
                                                error sit voluptatem accusa dolore mque laudant.</p>
                                            <figure class="image-box">
                                                <img src="{{ asset('frontend/assets/images/resource/floor-1.png') }}"
                                                    alt="">
                                            </figure>
                                        </div>
                                    </div>
                                </li>
                                <li class="accordion block">
                                    <div class="acc-btn">
                                        <div class="icon-outer"><i class="fas fa-angle-down"></i></div>
                                        <h5>Third Floor</h5>
                                    </div>
                                    <div class="acc-content">
                                        <div class="content-box">
                                            <p>Excepteur sint occaecat cupidatat non proident sunt in culpa qui officia
                                                deserunt mollit anim est laborum. Sed perspiciatis unde omnis iste natus
                                                error sit voluptatem accusa dolore mque laudant.</p>
                                            <figure class="image-box">
                                                <img src="{{ asset('frontend/assets/images/resource/floor-1.png') }}"
                                                    alt="">
                                            </figure>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div> --}}
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
                                        {{ optional($property->city)->name }}
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
                        <div class="author-widget sidebar-widget">
                            <div class="author-box">
                                <figure class="author-thumb"><img
                                        src="{{ asset('frontend/assets/images/resource/author-1.jpg') }}" alt="">
                                </figure>
                                <div class="inner">
                                    <h6 class="text-danger">Marketed By</h6>
                                    <h4>
                                        @if (isset($property))
                                            {{ $property->owner_name }}
                                        @endif
                                    </h4>
                                    <ul class="info clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i>84 St. John Wood High Street,
                                            St Johns Wood</li>
                                        <li><i class="fas fa-phone"></i><a
                                                href="tel:{{ $property->owner_phone }}">{{ $property->owner_phone }}</a>
                                        </li>
                                        <li><i class="fas fa-user"></i>Registered
                                            {{ $property->created_at->diffForHumans() }}</li>
                                        <li><i class="fas fa-home"></i><a href=""
                                                class="text-decoration-none text-secondary">View all properties from this
                                                owner</a></li>
                                    </ul>
                                    <div class="btn-box">


                                        <!-- Button trigger modal -->
                                        <button type="button" class="theme-btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Report Listing
                                        </button>
                                        <button type="button" class="theme-btn btn-success mt-3" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal2">
                                        Feedback
                                    </button>
                                    </div>
                                </div>
                                <!------Bootstrap Modal starts----->
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Report Listing with
                                                    {{ $property->property_code }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="padding: 30px;">
                                                <form action="{{ route('store.report.listing', $property->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput"
                                                            class="form-label">Reason</label>
                                                        <select id="inputState" class="form-select see" name="reason"
                                                            required>
                                                            <option selected>Select reason for reporting</option>
                                                            <option value="Offensive content or picture">Offensive content
                                                                or picture</option>
                                                            <option value="Property not available anymore">Property not
                                                                available anymore</option>
                                                            <option value="Owner not contactable">Owner not contactable
                                                            </option>
                                                            <option value="Fraudulent listing">Fraudulent listing</option>
                                                            <option value="Duplicated listing">Duplicated listing</option>
                                                            <option value="Different from the actual property">Different
                                                                from the actual property</option>
                                                            <option value="others">Others</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput2"
                                                            class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            required id="formGroupExampleInput2" placeholder="Enter name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput2"
                                                            class="form-label">Email</label>
                                                        <input type="email" name="email" required
                                                            class="form-control" id="formGroupExampleInput2"
                                                            placeholder="Enter Email">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Comment</label>
                                                        <textarea class="form-control" required id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                                                    </div>
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-danger" type="submit">Report
                                                            Listing</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-------Bootstrap Modal ends----->


                                                                <!------Bootstrap Modal starts----->
                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal2" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Feedback with
                                                    {{ $property->property_code }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body" style="padding: 30px;">
                                                <form action="{{ route('store.feedback', $property->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput2"
                                                            class="form-label">Name</label>
                                                        <input type="text" name="name" class="form-control"
                                                            required id="formGroupExampleInput2" placeholder="Enter name">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput2"
                                                            class="form-label">Email</label>
                                                        <input type="email" name="email" required
                                                            class="form-control" id="formGroupExampleInput2"
                                                            placeholder="Enter Email">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="formGroupExampleInput2"
                                                            class="form-label">Subject</label>
                                                        <input type="text" name="subject" required
                                                            class="form-control" id="formGroupExampleInput2"
                                                            placeholder="Enter Email">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlTextarea1"
                                                            class="form-label">Message</label>
                                                        <textarea class="form-control" required id="exampleFormControlTextarea1" name="message" rows="3"></textarea>
                                                    </div>
                                                    <div class="d-grid gap-2">
                                                        <button class="btn btn-success" type="submit">Feedback</button>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-------Bootstrap Modal ends----->
                            </div>
                            <div class="form-inner">
                                {{-- <form action="property-details.html" method="post" class="default-form">
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
                                </form> --}}
                            </div>
                        </div>
                        <div class="calculator-widget sidebar-widget">
                            <div class="calculate-inner">
                                <div class="widget-title">
                                    <h4>Feedback for Property {{$property->property_code}}</h4>
                                    <a href="javascript:void(0);" onclick="loadFeedbackDetails({{ $property->id }})"
                                        class="text-decoration-none text-success">View Details</a>
                                </div>

                                <!-- Placeholder for feedback details -->
                                <div id="feedback-details">

                                </div>
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
                                                    ${{ $property->price }}
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
        function redirectToBookingPage(propertyId) {
            // Redirect to a different route when "Book Now" is clicked
            window.location.href = "{{ url('property/book') }}/" + propertyId;
        }
    </script>

    <script>
        function initMap() {
            let propertyLocation = {
                lat: {{ $latitude }},
                lng: {{ $longitude }}
            };

            let map = new google.maps.Map(document.getElementById('map'), {
                center: propertyLocation,
                zoom: 15
            });

            new google.maps.Marker({
                position: propertyLocation,
                map: map,
                title: "Property Location"
            });
        }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNbcYZgvX1NfyeTb4k8q3_g5Y6OIBF5l8&callback=initMap">
    </script>

<script>
    function loadFeedbackDetails(propertyId) {
        $.ajax({
            url: "{{ route('feedback.detail', ['id' => '__id__']) }}".replace('__id__', propertyId),
            type: "GET",
            success: function(response) {
                let feedbackHtml = "";

                if (response.error) {
                    feedbackHtml = '<p style="color:red;">' + response.error + '</p>';
                } else {
                    response.forEach(feedback => {
                        feedbackHtml += `
                            <p><strong>Name:</strong> ${feedback.name}</p>
                            <p><strong>Subject:</strong> ${feedback.subject}</p>
                            <p><strong>Message:</strong> ${feedback.message}</p>
                            <hr>
                        `;
                    });
                }

                $('#feedback-details').html(feedbackHtml);
            },
            error: function() {
                $('#feedback-details').html('<p style="color:red;">Error loading feedback.</p>');
            }
        });
    }
</script>

@endsection
