@extends('frontend.master')

@section('home')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .see {
            display: block !important;
        }

        .nice-select {
            display: none !important;
        }

        .progress-bar-animated {
            transition: width 0.5s ease-in-out;
        }
    </style>
    <style>
        .progress {
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar-custom {
            background: linear-gradient(to right, #4caf50, #81c784);
            /* Green gradient */
            color: white;
            font-weight: bold;
        }

        .property-img {
            width: 300px !important;
            height: 350px !important;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .search-con {
            margin-top: 30px;
            box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            padding: 30px;
            border-radius: 10px;
        }

        #suggestions {
            position: absolute;
            background: white;
            border: 1px solid #ccc;
            max-width: 100%;
            z-index: 1000;
        }

        #suggestions div {
            padding: 10px;
            cursor: pointer;
        }

        #suggestions div:hover {
            background-color: #f0f0f0;
        }
    </style>


    <!-- Page Title -->
    {{-- <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
            </div>
            <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>All Property</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Book Property</li>
                </ul>
            </div>
        </div>
    </section> --}}
    <!-- End Page Title -->

    <!-- property-page-section -->
    <div class="container search-con">
        <form action="{{route('properties.search')}}" method="get">
            @csrf
            <div class="row ">
                <div class="col">
                    <!-- Location Input -->
                    <input type="text" id="location" name="location" placeholder="Enter city or state"
                        value="{{ request('location') }}" autocomplete="off" class="form-control inp" />
                    <div id="suggestions" style="display: none; border: 1px solid #ccc; max-height: 150px; overflow-y: auto;">
                    </div>

                </div>
                <div class="col">
                    <!-- Property Type Dropdown -->
                    <select name="property_type" class="form-select see inp">
                        <option value="">Select Property Type</option>
                        <option value="Flat" {{ request('property_type') == 'Flat' ? 'selected' : '' }}>Flat</option>
                        <option value="Bungalow" {{ request('property_type') == 'Bungalow' ? 'selected' : '' }}>Bungalow
                        </option>
                        <option value="Duplex" {{ request('property_type') == 'Duplex' ? 'selected' : '' }}>Duplex</option>
                        <option value="Hotel" {{ request('property_type') == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                        <option value="Shortlet" {{ request('property_type') == 'Shortlet' ? 'selected' : '' }}>Shortlet
                        </option>
                    </select>
                </div>
                <div class="col">
                    <button type="submit" id="search-pro" class="theme-btn btn-one">Search Property</button>
                </div>
            </div>
        </form>
    </div>
    <!---- property-list-section -->

    <!-- property-page-section -->
    <section class="property-page-section property-list">
        <div class="auto-container">
            @if (session('message'))
                <div class="alert alert-{{ session('status') == 'success' ? 'success' : 'danger' }} alert-dismissible fade show"
                    role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row clearfix">
                <div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
                    <div class="default-sidebar property-sidebar">
                        <div class="filter-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Search Property</h5>
                            </div>
                            <div class="widget-content">
                                <form id="property-status-form" method="GET"
                                    action="{{ route('filter.status.properties') }}">
                                    @csrf
                                    <div class="select-box">
                                        <select class="wide see form-control" id="status_id" name="property_status">
                                            <option data-display="This Area Only">Property Status</option>
                                            @foreach ($propertyStatus as $propertyStat)
                                                <option value="{{ $propertyStat->property_status }}">For
                                                    {{ ucfirst($propertyStat->property_status) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                <form id="property-type-form" method="GET"
                                    action="{{ route('filter.type.properties') }}">
                                    @csrf
                                    <div class="select-box">
                                        <select class="wide see form-control" id="type_id" name="ptype_id">
                                            <option data-display="">Property Type</option>
                                            @foreach ($propertyTypes as $propertyType)
                                                <option value="{{ $propertyType->id }}">
                                                    {{ $propertyType->type_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="filter-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Search Property</h5>
                            </div>
                            <div class="widget-content">
                                <form action="{{ route('search.book.properties') }}" method="post">
                                    @csrf
                                    <div class="select-box">
                                        <select class="wide see form-control" name="country_id">
                                            <option data-display="Select Location">Select Location</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="select-box" id="select-state-group" style="display: none;">
                                        <select name="state_id" id="" class="wide see form-control"
                                            style="display: block">

                                        </select>
                                    </div>
                                    <div class="select-box" id="select-city-group" style="display: none;">
                                        <select name="city_id" id="" class="wide see form-control"
                                            style="display: block">

                                        </select>
                                    </div>
                                    <div class="filter-btn">
                                        <button type="submit" class="theme-btn btn-one"><i
                                                class="fas fa-filter"></i>&nbsp;Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="filter-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Search Property</h5>
                            </div>
                            <div class="widget-content">
                                <form action="{{ route('search.price.properties') }}" method="post">
                                    @csrf
                                    <div class="select-box">
                                        <select class="wide see form-control" name="price">
                                            <option data-display="Select Location">Minimum Price</option>
                                            <!-- Loop through priceLowest -->
                                            @foreach ($priceLowest as $price)
                                                <option
                                                    value="{{ $currency == 'NGN' ? $price->price : $price->converted_price }}">
                                                    @if ($currency == 'NGN')
                                                        ₦ {{ number_format($price->price, 2) }}
                                                    @else
                                                        {{ $currency }}
                                                        {{ number_format($price->converted_price, 2) }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide see form-control" name="maximum_price">
                                            <option data-display="Select Location">Maximum Price</option>
                                            @foreach ($priceMax as $price)
                                                <option
                                                    value="{{ $currency == 'NGN' ? $price->price : $price->converted_price }}">
                                                    @if ($currency == 'NGN')
                                                        ₦ {{ number_format($price->maximum_price, 2) }}
                                                    @else
                                                        {{ $currency }}
                                                        {{ number_format($price->converted_price, 2) }}
                                                    @endif
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="filter-btn">
                                        <button type="submit" class="theme-btn btn-one"><i
                                                class="fas fa-filter"></i>&nbsp;Filter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="category-widget sidebar-widget">
                            <a href="#">
                                <img src="{{ asset('frontend/assets/images/adverts/adverts.png') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                        <div class="category-widget sidebar-widget">
                            <a href="{{ route('sell.my.property.details') }}">
                                <img src="{{ asset('frontend/assets/images/adverts/adverts2.png') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                        <div class="category-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Status Of Property</h5>
                            </div>
                            <ul class="category-list clearfix">
                                <li><a href="{{ route('rent.properties') }}">For Rent
                                        <span>
                                            @if ($propertyStatusRent && count($propertyStatusRent) > 0)
                                                ({{ count($propertyStatusRent) }})
                                            @else
                                                <!-- Handle the case when properties are not available -->
                                                (0)
                                            @endif
                                        </span>
                                    </a>
                                </li>
                                <li><a href="{{ route('buy.properties') }}">For Buy
                                        <span>
                                            @if ($propertyStatusBuy && count($propertyStatusBuy) > 0)
                                                ({{ count($propertyStatusBuy) }})
                                            @else
                                                <!-- Handle the case when properties are not available -->
                                                (0)
                                            @endif
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="category-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Amenities</h5>
                            </div>
                            <ul class="category-list clearfix">
                                <li><a href="property-details.html">Air Conditioning <span>(17)</span></a></li>
                                <li><a href="property-details.html">Central Heating <span>(4)</span></a></li>
                                <li><a href="property-details.html">Cleaning Service <span>(12)</span></a></li>
                                <li><a href="property-details.html">Dining Room <span>(8)</span></a></li>
                                <li><a href="property-details.html">Dishwasher <span>(5)</span></a></li>
                                <li><a href="property-details.html">Dishwasher <span>(2)</span></a></li>
                                <li><a href="property-details.html">Family Room <span>(19)</span></a></li>
                                <li><a href="property-details.html">Onsite Parking <span>(11)</span></a></li>
                                <li><a href="property-details.html">Fireplace <span>(7)</span></a></li>
                                <li><a href="property-details.html">Hardwood Flows <span>(9)</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-12 col-sm-12 content-side">
                    <div class="property-content-side">
                        <div class="item-shorting clearfix">
                            <div class="left-column pull-left">
                                <h5>Search Results: <span>Showing {{ count($properties) }} Listings</span></h5>
                            </div>
                            <div class="right-column pull-right clearfix">
                                <div class="short-box clearfix">
                                    <div class="select-box">
                                        <form id="property-sort-form" method="GET"
                                            action="{{ route('filter.sort.properties') }}">
                                            @csrf
                                            <select class="wide see form-select" id="sort_id" name="sort">
                                                <option data-display="Sort By">Sort By</option>
                                                <option value="latest"
                                                    {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>
                                                    Price: Low to High</option>
                                                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>
                                                    Price: High to Low</option>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="short-menu clearfix">
                                    <button class="list-view on"><i class="icon-35"></i></button>
                                    {{-- <button class="grid-view"><i class="icon-36"></i></button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="wrapper list">
                            <div class="deals-list-content list-item">

                                @if ($properties->isEmpty())
                                    <p>No active records found.</p>
                                @else
                                    {{-- {{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image2.jpeg') }} --}}
                                    @foreach ($properties as $item)
                                        <div class="deals-block-one">
                                            <div class="inner-box">
                                                <div class="image-box">
                                                    <figure class="image"><img
                                                            src="{{ !empty($item->property_thumbnail) ? url($item->property_thumbnail) : url($item->multi_img) }}"
                                                            alt="" class="property-img"></figure>
                                                    <div class="batch"><i class="icon-11"></i></div>
                                                    <span class="category">
                                                        @if ($item->featured == 1)
                                                            <span>Featured</span>
                                                        @else
                                                            <span>Hot</span>
                                                        @endif
                                                    </span>
                                                    <div class="buy-btn"><a href="property-details.html">
                                                            {{ ucfirst($item->property_status) }} Now</a></div>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="title-text d-flex justify-content-between">
                                                        <h4><a
                                                                href="property-details.html">{{ ucwords($item->property_name) }}</a>
                                                        </h4>
                                                        <div class="text-center">
                                                            @if ($item->verification_status == '1')
                                                                <span class="badge text-bg-success p-1">verified</span>
                                                            @else
                                                                <span class="badge text-bg-danger p-1">unverified</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        <div class="price-info pull-left">
                                                            <h6>Start From</h6>
                                                            <h4>
                                                                @if ($item->type->type_name == 'Hotel' || $item->type->type_name == 'Shortlet')
                                                                    @if ($currency == 'NGN')
                                                                        {{ '₦ ' . number_format($item->price_per_night, 2) }}
                                                                        <small style="font-size: 0.9rem; color: gray;">Per
                                                                            Night</small>
                                                                        <!-- Display price per night in NGN -->
                                                                    @else
                                                                        {{ $currency . ' ' . number_format($item->price_per_night_converted, 2) }}
                                                                        <small style="font-size: 0.9rem; color: gray;">Per
                                                                            Night</small>
                                                                        <!-- Display converted price per night -->
                                                                    @endif
                                                                @else
                                                                    @if ($currency == 'NGN')
                                                                        {{ '₦ ' . number_format($item->price, 2) }}
                                                                        <!-- Display regular price in NGN -->
                                                                    @else
                                                                        {{ $currency . ' ' . number_format($item->price_converted, 2) }}
                                                                        <!-- Display converted regular price -->
                                                                    @endif
                                                                @endif

                                                            </h4>
                                                            {{-- <h4>{{ $currency }} {{ number_format($item->price * $exchangeRate, 2) }}
                                                            </h4> --}}
                                                        </div>
                                                        <div class="author-box pull-right">
                                                            <figure class="author-thumb">
                                                                <img src="{{ asset('frontend/assets/images/feature/author-1.jpg') }}"
                                                                    alt="">
                                                                <span>{{ $item->type->type_name }}</span>
                                                            </figure>
                                                        </div>
                                                    </div>
                                                    <p>{{ substr($item->long_description, 0, 92) }}</p>
                                                    <ul class="more-details clearfix">
                                                        <li><i
                                                                class="icon-14"></i>{{ $item->bedrooms ? $item->bedrooms : 3 }}
                                                            Beds</li>
                                                        <li><i
                                                                class="icon-15"></i>{{ $item->bathrooms ? $item->bathrooms : 2 }}
                                                            Baths</li>
                                                        <li><i class="icon-16"></i>600 Sq Ft</li>
                                                    </ul>
                                                    <div class="other-info-box clearfix">
                                                        <div class="btn-box pull-left"><a
                                                                href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}"
                                                                class="theme-btn btn-two">See Details</a></div>
                                                        <ul class="other-option pull-right clearfix">
                                                            <div class="btn-box pull-left">
                                                                <button type="button" class="theme-btn btn-success"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal-{{ $item->id }}"
                                                                    @if ($item->property_status !== 'buy' && $item->property_status !== 'rent' && $item->property_status !== 'lease') onclick="redirectToBookingPage('{{ $item->id }}')" @endif>
                                                                    @if ($item->property_status === 'buy')
                                                                        Buy Now
                                                                    @elseif($item->property_status === 'rent')
                                                                        Rent Now
                                                                    @elseif($item->property_status === 'lease')
                                                                        Lease Now
                                                                    @else
                                                                        Book Now
                                                                    @endif
                                                                </button>
                                                            </div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!------Bootstrap Modal starts----->
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal-{{ $item->id }}" data-bs-backdrop="static"
                                            data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="modalLabel-{{ $item->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modalLabel-{{ $item->id }}">
                                                            Select The
                                                            Type Of User</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer  mx-auto">
                                                        <button type="button" class="btn btn-danger"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdrop2-{{ $item->id }}">Proceed
                                                            as a Guest
                                                        </button>
                                                        @auth
                                                            <a href="{{ route('user.auth.booking', $item->id) }}"
                                                                type="button" class="btn btn-success">Book as a User
                                                            </a>
                                                        @endauth

                                                        @guest
                                                            <a href="{{ route('user.auth.booking', $item->id) }}"
                                                                type="button" class="btn btn-primary">Login as a User
                                                            </a>
                                                        @endguest
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal fade" id="staticBackdrop2-{{ $item->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="staticBackdrop2Label-{{ $item->id }}">
                                                            {{-- @if ($item->property_status === 'buy')
                                                                Buy Now
                                                            @elseif($item->property_status === 'rent')
                                                                Rent Now
                                                            @elseif($item->property_status === 'lease')
                                                                Lease Now
                                                            @else
                                                                Book Now
                                                            @endif --}}
                                                            Submit Request
                                                            <small>
                                                                @php

                                                                    $availabilities = App\Models\Availability::where(
                                                                        'property_id',
                                                                        $item->id,
                                                                    )->first();
                                                                @endphp
                                                                @if ($availabilities)
                                                                    <div class="alert alert-success" role="alert">
                                                                        Available date for inspection: <br>
                                                                        {{ \Carbon\Carbon::parse($availabilities->start_date)->format('jS F Y') }}
                                                                        -
                                                                        {{ \Carbon\Carbon::parse($availabilities->end_date)->format('jS F Y') }}
                                                                        <br>
                                                                        <div>
                                                                            Time:
                                                                            {{ \Carbon\Carbon::parse($availabilities->start_time)->format('g:i A') }}
                                                                        </div>
                                                                    </div>
                                                                @else
                                                                    <div class="alert alert-success" role="alert">
                                                                        No available date for inspection
                                                                    </div>
                                                                @endif
                                                            </small>
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body p-4">

                                                        <form action="{{ route('viewing.request', $item->id) }}"
                                                            method="post">
                                                            @csrf
                                                            <div class="mb-3">
                                                                <label for="requested_time" class="form-label">Full
                                                                    Name</label>
                                                                <input type="text" name="name" id=""
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="requested_time"
                                                                    class="form-label">Email</label>
                                                                <input type="email" name="email" id=""
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="requested_time"
                                                                    class="form-label">Phone</label>
                                                                <input type="text" name="phone" id=""
                                                                    class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="requested_time" class="form-label">Select
                                                                    Date</label>
                                                                <input type="date" name="requested_date"
                                                                    id="requested_date" class="form-control" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="requested_time" class="form-label">Select
                                                                    Time</label>
                                                                <input type="time" name="requested_time"
                                                                    id="requested_time" class="form-control" required>
                                                            </div>
                                                            <div class="d-grid gap-2 form-group message-btn">
                                                                <button type="submit" class="theme-btn btn-one">Request
                                                                    Viewing</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Understood</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-------Bootstrap Modal ends----->
                                    @endforeach
                                @endif

                            </div>

                        </div>
                        <div class="">
                            <div class="">
                                {!! $properties->links('pagination::bootstrap-5') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- property-page-section end -->



    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {
            $('select[name="country_id"]').on('change', function() {
                var country_id = $(this).val();
                // Add IDs of African countries here
                var africanCountries = [3, 6, 23, 28, 34, 37, 39, 41, 49, 50, 53,
                    59, 64, 66, 67, 69, 79, 80, 83, 92, 93, 113, 122, 123, 124, 130,
                    131, 134, 139, 140, 148, 149, 151, 159, 160, 170, 182, 192, 194,
                    195, 201, 202, 204, 207, 210, 216, 218, 222, 227, 245, 246
                ];
                if (country_id) {
                    console.log("Fetching states for country ID:", country_id); // Log the country ID
                    $.ajax({
                        url: "{{ url('/get-states-location/ajax') }}/" + country_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data); // Log the response data
                            $('select[name="state_id"]').empty().append(
                                '<option value="">Select State</option>');

                            if (data.length > 0) {
                                $('#select-state-group').show();
                                $.each(data, function(key, value) {
                                    $('select[name="state_id"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .name + '</option>'
                                    );
                                });
                            } else {
                                $('select[name="state_id"]').append(
                                    '<option value="">No states available</option>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log('AJAX Error: ' + textStatus + ': ' + errorThrown);
                        }
                    });
                } else {
                    alert('Please select a country');
                }
                // Show or hide the postal code field
                if (africanCountries.includes(parseInt(country_id))) {
                    $('#postal-code-group').hide(); // Hide if African country
                } else {
                    $('#postal-code-group').show(); // Show if non-African country
                }
            });


            // City
            $('select[name="state_id"]').on('change', function() {
                let state_id = $(this).val();
                if (state_id) {
                    $.ajax({
                        url: "{{ url('/get-cities-location/ajax') }}/" + state_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            console.log(data); // Log the response data
                            $('select[name="city_id"]').empty().append(
                                '<option value="">Select City</option>');
                            if (data.length > 0) {
                                $('#select-city-group').show();
                                $.each(data, function(key, value) {
                                    $('select[name="city_id"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .name + '</option>');
                                });
                            } else {
                                $('select[name="city_id"]').append(
                                    '<option value="">No cities available</option>');
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.log('AJAX Error: ' + textStatus + ': ' + errorThrown);
                        }
                    });
                } else {
                    $('select[name="city_id"]').empty().append('<option value="">Select City</option>');
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusField = document.getElementById('status_id');

            if (statusField) {
                statusField.addEventListener('change', function() {
                    const selectedStatus = statusField.value;

                    if (selectedStatus) {
                        // Redirect to the URL with the selected property_status
                        window.location.href = `/properties?property_status=${selectedStatus}`;
                    }
                });
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sortField = document.getElementById('sort_id');
            const form = document.getElementById('property-sort-form');

            // Handle sort changes
            if (sortField) {
                sortField.addEventListener('change', function() {
                    form.submit(); // Automatically submit the form
                });
            }
        });
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const typeField = document.getElementById('type_id');

            if (typeField) {
                typeField.addEventListener('change', function() {
                    const selectedType = typeField.value;

                    if (selectedType) {
                        // Redirect to the URL with the selected property_status
                        window.location.href = `/properties/type?ptype_id=${selectedType}`;
                    }
                });
            }
        });
    </script>

    <script>
        document.getElementById('type_id').addEventListener('change', function() {
            document.getElementById('property-type-form').submit();
            console.log("Success!");

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Trigger the user choice modal on "Book Now" click
            document.getElementById('bookNowBtn').addEventListener('click', function() {
                new bootstrap.Modal(document.getElementById('userChoiceModal')).show();
            });

            // Show guest user form modal
            document.getElementById('guestUserBtn').addEventListener('click', function() {
                let userChoiceModal = bootstrap.Modal.getInstance(document.getElementById(
                    'userChoiceModal'));
                userChoiceModal.hide(); // Hide the first modal
                new bootstrap.Modal(document.getElementById('guestUserFormModal')).show();
            });

            // Redirect to login page for registered user
            document.getElementById('registeredUserBtn').addEventListener('click', function() {
                let userChoiceModal = bootstrap.Modal.getInstance(document.getElementById(
                    'userChoiceModal'));
                userChoiceModal.hide(); // Hide the first modal
                window.location.href = "{{ route('login') }}"; // Adjust route name as necessary
            });
        });
    </script>

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
        function redirectToBookingPage(propertyId) {
            // Redirect to a different route when "Book Now" is clicked
            window.location.href = "{{ url('property/book') }}/" + propertyId;
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('location').addEventListener('input', function() {
                const query = this.value;
                if (query.length > 2) {
                    fetch(`/api/locations?query=${query}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Suggestions:', data); // Debugging
                            const suggestionsDiv = document.getElementById('suggestions');
                            suggestionsDiv.innerHTML = ''; // Clear previous suggestions

                            if (data.length > 0) {
                                data.forEach(item => {
                                    const suggestion = document.createElement('div');
                                    suggestion.textContent = item.name;
                                    suggestion.style.cursor = 'pointer';
                                    suggestion.addEventListener('click', () => {
                                        document.getElementById('location').value = item
                                            .name;
                                        suggestionsDiv.style.display = 'none';
                                    });
                                    suggestionsDiv.appendChild(suggestion);
                                });
                                suggestionsDiv.style.display = 'block';
                            } else {
                                suggestionsDiv.style.display = 'none';
                            }
                        })
                        .catch(error => console.error('Fetch error:', error));
                } else {
                    document.getElementById('suggestions').style.display = 'none';
                }
            });
        });
    </script>

@endsection
