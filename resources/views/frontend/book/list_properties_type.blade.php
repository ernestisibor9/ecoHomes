@extends('frontend.master')

@section('home')
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
    </style>

    <!-- Page Title -->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
            </div>
            <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Book Property</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Book Property</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- property-page-section -->
    <section class="property-page-section property-list">
        <div class="auto-container">
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
                                                <option value="{{ $propertyStat->property_status }}">
                                                    {{ ucfirst($propertyStat->property_status) }} Now</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                                <form id="property-type-form" method="GET" action="{{ route('filter.type.properties') }}">
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
                                    {{-- <div class="select-box">
                                        <select class="wide see form-control" name="lowest_price">
                                            <option data-display="Most Popular">Minimum Price</option>
                                            @foreach ($priceLowest as $lowestPrice)
                                                <option value="{{ $lowestPrice->lowest_price }}">
                                                    ${{ $lowestPrice->lowest_price }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide see form-control" name="maximum_price">
                                            <option data-display="Most Popular">Maximum Price</option>
                                            @foreach ($priceMax as $maxPrice)
                                                <option value="{{ $maxPrice->maximum_price }}">
                                                    ${{ $maxPrice->maximum_price }}</option>
                                            @endforeach
                                        </select>
                                    </div> --}}
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
                                        <select class="wide see form-control" name="lowest_price">
                                            <option data-display="Select Location">Mininmum Price</option>
                                            @foreach ($priceLowest as $lowest_price)
                                                <option value="{{ $lowest_price->lowest_price }}">
                                                    {{ $lowest_price->lowest_price }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="select-box">
                                        <select class="wide see form-control" name="maximum_price">
                                            <option data-display="Select Location">Maximum Price</option>
                                            @foreach ($priceMax as $maximum_price)
                                                <option value="{{ $maximum_price->maximum_price }}">
                                                    {{ $maximum_price->maximum_price }}</option>
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
                        {{-- <div class="price-filter sidebar-widget">
                            <div class="widget-title">
                                <h5>Select Price Range</h5>
                            </div>
                            <div class="range-slider clearfix">
                                <div class="clearfix">
                                    <div class="input">
                                        <input type="text" class="property-amount" name="field-name" readonly="">
                                    </div>
                                </div>
                                <div class="price-range-slider"></div>
                            </div>
                        </div> --}}
                        <div class="category-widget sidebar-widget">
                            <div class="widget-title">
                                <h5>Status Of Property</h5>
                            </div>
                            <ul class="category-list clearfix">
                                <li><a href="property-details.html">For Rent
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
                                <li><a href="property-details.html">For Buy
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
                                <li><a href="property-details.html">For Sell
                                        <span>
                                            @if ($propertyStatusSell && count($propertyStatusSell) > 0)
                                                ({{ count($propertyStatusSell) }})
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
                                <h5>Search Results: <span>Showing {{ count($paginatedData) }} Listings</span></h5>
                            </div>
                            <div class="right-column pull-right clearfix">
                                <div class="short-box clearfix">
                                    <div class="select-box">
                                        <select class="wide see">
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
                                    {{-- <button class="grid-view"><i class="icon-36"></i></button> --}}
                                </div>
                            </div>
                        </div>
                        <div class="wrapper list">
                            <div class="deals-list-content list-item">

                                @if ($paginatedData->isEmpty())
                                    <p>No active records found.</p>
                                @else
                                    {{-- {{ !empty($profileData->photo) ? url('upload/admin_images/' . $profileData->photo) : url('upload/no_image2.jpeg') }} --}}
                                    @foreach ($paginatedData as $item)
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
                                                    <div class="buy-btn"><a href="property-details.html">For
                                                            {{ ucfirst($item->property_status) }}</a></div>
                                                </div>
                                                <div class="lower-content">
                                                    <div class="title-text">
                                                        <h4><a
                                                                href="property-details.html">{{ ucwords($item->property_name) }}</a>
                                                        </h4>
                                                    </div>
                                                    <div class="price-box clearfix">
                                                        <div class="price-info pull-left">
                                                            <h6>Start From</h6>
                                                            <h4>${{ $item->lowest_price }}</h4>
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
                                                            {{-- <li><a href="property-details.html"><i
                                                                        class="icon-12"></i></a></li>
                                                            <li><a href="property-details.html"><i
                                                                        class="icon-13"></i></a></li> --}}
                                                            <div class="btn-box pull-left"><a href="property-details.html"
                                                                    class="theme-btn btn-success">Book Now</a></div>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>

                        </div>
                        <div class="">
                            <div class="">
                                {!! $paginatedData->links('pagination::bootstrap-5') !!}
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


@endsection