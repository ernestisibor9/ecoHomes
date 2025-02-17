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
    .featured-img {
        width: 370px !important;
        height: 250px !important;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .featured-container {
        margin-top: -70px;
    }

    .feat {
        margin-top: -80px;
    }

    .feat-property {
        margin-top: 120px;
    }
</style>

<style>
    .rating {
        display: flex;
        flex-direction: row;
        justify-content: center;
        color: gold;
    }
</style>


<style>
    .search-bar {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .property-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        background: #fff;
        transition: transform 0.2s ease-in-out;
    }

    /* .property-card:hover {
        transform: translateY(-5px);
    } */

    .property-image {
        width: 100%;
        height: 180px;
        /* Ensures uniform height */
        overflow: hidden;
        border-radius: 8px;
    }

    .property-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .property-details {
        flex-grow: 1;
        padding: 10px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .property-details h4 {
        font-size: 1rem;
        font-weight: bold;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 5px;
    }

    .property-details p {
        font-size: 0.85rem;
        color: #555;
        margin-bottom: 5px;
        flex-grow: 1;
    }

    .price {
        font-size: 1rem;
        font-weight: bold;
        color: #dc3545;
        margin-bottom: 5px;
    }

    .property-info {
        font-size: 0.85rem;
        color: #777;
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .property-info span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .btn-group {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .theme-btn {
        font-size: 0.85rem;
        padding: 8px 12px;
        border-radius: 5px;
        text-decoration: none;
        transition: 0.3s;
    }

    .theme-btn:hover {
        opacity: 0.8;
    }

    .btn-danger {
        background-color: #dc3545;
        color: white;
        border: none;
        cursor: pointer;
    }

    .phone-number {
        display: none;
        font-size: 0.85rem;
    }




    @media (min-width: 768px) {
        .property-card {
            flex-direction: column;
            height: 100%;
        }

        .property-details {
            flex: 1;
        }

        .btn-group {
            flex-direction: row;
            justify-content: space-between;
        }
    }
</style>



<!-- search-field-section -->
<section class="search-field-section style-two feat-property">
    <div class="auto-container">
        <div class="inner-container">
            <div class="search-field">
                <div class="tabs-box">
                    <div class="tabs-content info-group">
                        <ul class="tab-btns tab-buttons clearfix">
                            <li class="tab-btn active-btn" data-tab="#tab-1">For Buy</li>
                            <li class="tab-btn" data-tab="#tab-2">For Rent</li>
                        </ul>
                        <div class="tab active-tab" id="tab-1">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="{{route('properties.search2')}}" method="get" class="search-form">
                                        @csrf
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Search Property</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="search" id="location" name="location"
                                                            placeholder="Search by Property, Location or Landmark..."
                                                            value="{{ request('location') }}" autocomplete="off">
                                                            <div id="suggestions"
                                                            style="display: none; border: 1px solid #ccc; max-height: 150px; overflow-y: auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Property Type</label>
                                                    <div class="select-box">
                                                        {{-- <i class="far fa-compass"></i> --}}
                                                        <select class="form-select see" name="property_type">
                                                            <option data-display="Input location">Property Type
                                                            </option>
                                                            @foreach ($listPropertyTypes as $type)
                                                            <option value="{{ $type->property_type }}"
                                                                {{ request('property_type') == $type->property_type ? 'selected' : '' }}>
                                                                {{ $type->property_type}}
                                                            </option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Property Type</label>
                                                    <div class="select-box">
                                                        <select class="form-select see" name="property_status">
                                                            <option data-display="Input location">Property Status
                                                            </option>
                                                            @foreach ($listPropertyStatus as $status)
                                                            <option value="{{ $status->property_status }}"
                                                                {{ request('property_status') == $status->property_status ? 'selected' : '' }}>
                                                                {{ $status->property_status}}
                                                            </option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="switch_btn_one ">
                                    {{-- <button
                                        class="nav-btn nav-toggler navSidebar-button clearfix search__toggler">Advanced
                                        Search<i class="fas fa-angle-down"></i></button> --}}
                                    <div class="advanced-search">
                                        <div class="close-btn">
                                            <a href="#" class="close-side-widget"><i class="far fa-times"></i></a>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Distance from Location</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Distance from Location">Distance from
                                                                Location</option>
                                                            <option value="1">Max Bath</option>
                                                            <option value="2">Within 1 Mile</option>
                                                            <option value="3">Within 2 Mile</option>
                                                            <option value="4">Within 3 Mile</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bedrooms</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Max Rooms">Max Rooms</option>
                                                            <option value="1">One Rooms</option>
                                                            <option value="2">Two Rooms</option>
                                                            <option value="3">Three Rooms</option>
                                                            <option value="4">Four Rooms</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Sort by</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Most Popular">Most Popular</option>
                                                            <option value="1">Top Rating</option>
                                                            <option value="2">New Rooms</option>
                                                            <option value="3">Classic Rooms</option>
                                                            <option value="4">Luxry Rooms</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Floor</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Select Floor">Select Floor</option>
                                                            <option value="1">One Floor</option>
                                                            <option value="2">Two Floor</option>
                                                            <option value="3">Three Floor</option>
                                                            <option value="4">Four Floor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bath</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Max Bath">Max Bath</option>
                                                            <option value="1">Max Bath</option>
                                                            <option value="2">Max Bath</option>
                                                            <option value="3">Max Bath</option>
                                                            <option value="4">Max Bath</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Agencies</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Any Agency">Any Agency</option>
                                                            <option value="1">Any Agency</option>
                                                            <option value="2">Agency 01</option>
                                                            <option value="3">Agency 02</option>
                                                            <option value="4">Agency 03</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="range-box">
                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="price-range">
                                                        <h6>Select Price Range</h6>
                                                        <div class="range-input">
                                                            <div class="input"><input type="text"
                                                                    class="property-amount" name="field-name"
                                                                    readonly=""></div>
                                                        </div>
                                                        <div class="price-range-slider"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="area-range">
                                                        <h6>Select Area</h6>
                                                        <div class="range-input">
                                                            <div class="input"><input type="text"
                                                                    class="area-range" name="field-name"
                                                                    readonly=""></div>
                                                        </div>
                                                        <div class="area-range-slider"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab" id="tab-2">
                            <div class="inner-box">
                                <div class="top-search">
                                    <form action="index.html" method="post" class="search-form">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-12 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Search Property</label>
                                                    <div class="field-input">
                                                        <i class="fas fa-search"></i>
                                                        <input type="search" name="search-field"
                                                            placeholder="Search by Property, Location or Landmark..."
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Location</label>
                                                    <div class="select-box">
                                                        <i class="far fa-compass"></i>
                                                        <select class="wide">
                                                            <option data-display="Input location">Input location
                                                            </option>
                                                            <option value="1">New York</option>
                                                            <option value="2">California</option>
                                                            <option value="3">London</option>
                                                            <option value="4">Maxico</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Property Type</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="All Type">All Type</option>
                                                            <option value="1">Laxury</option>
                                                            <option value="2">Classic</option>
                                                            <option value="3">Modern</option>
                                                            <option value="4">New</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="search-btn">
                                            <button type="submit"><i class="fas fa-search"></i>Search</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="switch_btn_one ">
                                    <button
                                        class="nav-btn nav-toggler navSidebar-button clearfix search__toggler">Advanced
                                        Search<i class="fas fa-angle-down"></i></button>
                                    <div class="advanced-search">
                                        <div class="close-btn">
                                            <a href="#" class="close-side-widget"><i
                                                    class="far fa-times"></i></a>
                                        </div>
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Distance from Location</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Distance from Location">Distance from
                                                                Location</option>
                                                            <option value="1">Max Bath</option>
                                                            <option value="2">Within 1 Mile</option>
                                                            <option value="3">Within 2 Mile</option>
                                                            <option value="4">Within 3 Mile</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bedrooms</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Max Rooms">Max Rooms</option>
                                                            <option value="1">One Rooms</option>
                                                            <option value="2">Two Rooms</option>
                                                            <option value="3">Three Rooms</option>
                                                            <option value="4">Four Rooms</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Sort by</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Most Popular">Most Popular</option>
                                                            <option value="1">Top Rating</option>
                                                            <option value="2">New Rooms</option>
                                                            <option value="3">Classic Rooms</option>
                                                            <option value="4">Luxry Rooms</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Floor</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Select Floor">Select Floor</option>
                                                            <option value="1">One Floor</option>
                                                            <option value="2">Two Floor</option>
                                                            <option value="3">Three Floor</option>
                                                            <option value="4">Four Floor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Bath</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Max Bath">Max Bath</option>
                                                            <option value="1">Max Bath</option>
                                                            <option value="2">Max Bath</option>
                                                            <option value="3">Max Bath</option>
                                                            <option value="4">Max Bath</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12 column">
                                                <div class="form-group">
                                                    <label>Agencies</label>
                                                    <div class="select-box">
                                                        <select class="wide">
                                                            <option data-display="Any Agency">Any Agency</option>
                                                            <option value="1">Any Agency</option>
                                                            <option value="2">Agency 01</option>
                                                            <option value="3">Agency 02</option>
                                                            <option value="4">Agency 03</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="range-box">
                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="price-range">
                                                        <h6>Select Price Range</h6>
                                                        <div class="range-input">
                                                            <div class="input"><input type="text"
                                                                    class="property-amount" name="field-name"
                                                                    readonly=""></div>
                                                        </div>
                                                        <div class="price-range-slider"></div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-12 column">
                                                    <div class="area-range">
                                                        <h6>Select Area</h6>
                                                        <div class="range-input">
                                                            <div class="input"><input type="text"
                                                                    class="area-range" name="field-name"
                                                                    readonly=""></div>
                                                        </div>
                                                        <div class="area-range-slider"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search-field-section end -->

<!-- deals-style-two -->
<section class="deals-style-two">
    <div class="auto-container">
        <div class="item-shorting clearfix">
            <div class="left-column pull-left">
                <h5>Search Results: <span>{{count($properties)}} Properties Found</span></h5>
            </div>
            <div class="right-column pull-right clearfix">
                <div class="short-box clearfix">
                    <div class="select-box">
                        <select class="wide">
                            <option data-display="Sort by: Newest">Sort by: Newest</option>
                            <option value="1">New Arrival</option>
                            <option value="2">Top Rated</option>
                            <option value="3">Offer Place</option>
                            <option value="4">Most Place</option>
                        </select>
                    </div>
                </div>
                <div class="short-menu clearfix">
                    <button class="list-view on"><i class="icon-35"></i></button>
                    <button class="grid-view"><i class="icon-36"></i></button>
                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row mt-4">
                @if ($properties->isEmpty())
                <p>No active records found.</p>
            @else
                @foreach ($properties as $property)
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="property-card">
                            <div class="property-image">
                                <img src="{{ !empty($property->property_thumbnail) ? url($property->property_thumbnail) : asset('frontend/feature-4.jpg') }}"
                                    alt="Property Image">
                            </div>
                            <div class="property-details">
                                <h4>{{ $property->property_title }}</h4>
                                <p class="text-danger">{{ $property->property_variant }} for {{ $property->property_status }}</p>
                                <div class="price text-success">
                                    @if ($currency == 'NGN')
                                        ₦ {{ number_format($property->price, 2) }}
                                    @else
                                        {{ $currency . ' ' . number_format($property->price_converted, 2) }}
                                    @endif
                                </div>
                                <div class="property-info">
                                    @if ($property->bedroom)
                                        <span><i class="fa fa-bed"></i> {{ $property->bedroom }} Bed</span>
                                    @endif
                                    @if ($property->bathroom)
                                        <span><i class="fa fa-bath"></i> {{ $property->bathroom }} Bath</span>
                                    @endif
                                    @if ($property->toilet)
                                        <span><i class="fa fa-toilet"></i> {{ $property->toilet }} Toilet</span>
                                    @endif
                                    @if ($property->property_type === 'land')
                                        <span><i class="fa fa-ruler-combined"></i> {{ $property->size }}</span>
                                    @endif
                                </div>
                                <p class="mt-2"><i class="fa fa-map-marker-alt"></i> {{ $property->state->name }},
                                    {{ $property->country->name }}</p>
                                <p class="text-muted">{{ Str::limit($property->description, 100, '...') }}</p>
                                <div class="btn-group">
                                    <a href="{{ url('list-property/details/' . $property->id . '/' . $property->property_slug) }}"
                                        class="theme-btn btn-one btn-primary">View Details</a>
                                    <!-- Show Phone Button -->
                                    <button type="button" class="theme-btn btn-danger show-phone-btn"
                                    onclick="showPhoneNumber(this, '{{ $property->owner_phone }}')">
                                Show Phone
                            </button>

                            <!-- Hidden Phone Number -->
                            <span class="phone-number d-none text-dark">
                                <i class="fa fa-phone"></i> <span class="phone-text"></span>
                            </span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @endif
            </div>
        </div>



    </div>
    <div class="pagination-wrapper">
        <div class="">
            {!! $properties->links('pagination::bootstrap-5') !!}
        </div>
    </div>
    </div>
</section>

<script>
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
</script>

<script>
    function showPhoneNumber(button, phoneNumber) {
        // Get the closest span element inside the same container
        let phoneSpan = button.nextElementSibling;

        // Set phone number text and show it
        phoneSpan.querySelector('.phone-text').innerText = phoneNumber;
        phoneSpan.style.display = 'inline';

        // Hide the button
        button.style.display = 'none';
    }
</script>

<script>
    document.getElementById("show-phone").addEventListener("click", function() {
        fetch('/track-action', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ action: "phone_number_clicked" })
        })
        .then(response => response.json())
        .then(data => console.log("Tracked:", data))
        .catch(error => console.error("Error:", error));
    });
    </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/track-action', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // For security
            },
            body: JSON.stringify({ action: 'page_view' })
        });
    });
    </script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('location').addEventListener('input', function() {
            const query = this.value;
            if (query.length > 2) {
                fetch(`/api/locations2?query=${query}`)
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
<!-- deals-style-two end -->

@endsection
