@php

@endphp


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
    .feat{
        margin-top: -80px;
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


<section class="feature-section sec-pad bg-color-1">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5 class="feat">Features</h5>
            <h2>Featured Property</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing sed do eiusmod tempor incididunt <br />labore dolore
                magna aliqua enim.</p>
        </div>
        <div class="row clearfix">

            @foreach ($hotels as $hotel)
                @foreach ($hotel->rooms as $room)
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms"
                            data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        @if ($room->roomImages->count() > 0)
                                            {{-- Display only the first image for each room type --}}
                                            <figure class="image">
                                                <img src="{{ asset('storage/' . $room->roomImages->first()->image_path) }}"
                                                    alt="Room Image" class="featured-img">
                                            </figure>
                                        @else
                                            <figure class="image">
                                                <img src="{{ asset('frontend/assets/images/default-room.jpg') }}"
                                                    alt="Default Room Image" class="featured-img">
                                            </figure>
                                        @endif
                                    </figure>
                                    <div class="batch"><i class="icon-11"></i></div>
                                    <span class="category">Featured</span>
                                </div>
                                <div class="lower-content">
                                    <div class="author-info clearfix">
                                        <div class="author pull-left">
                                            <figure class="author-thumb"><img src="assets/images/feature/author-1.jpg"
                                                    alt=""></figure>
                                            <h6>{{ $hotel->hotel_name }}</h6>
                                            <ul class="rating clearfix pull-left input">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($hotel->rating >= $i)
                                                        <li><i class="icon-39"></i></li> <!-- Full star -->
                                                    @else
                                                        <li><i class="icon-40"></i></li> <!-- Empty star -->
                                                    @endif
                                                @endfor
                                            </ul>
                                        </div>
                                        <div class="buy-btn pull-right"><a
                                                href="property-details.html">{{ $room->details->room_type }}</a></div>
                                    </div>
                                    <div class="title-text">
                                        <h4><a href="property-details.html">{{ $room->room_name }}</a></h4>
                                    </div>
                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6>Start From</h6>
                                            <h4>
                                                @if ($room->details)
                                                    {{ '₦ ' . number_format($room->details->price_per_night, 2) }}
                                                @endif
                                            </h4>
                                        </div>
                                        <ul class="other-option pull-right clearfix">
                                            <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                            <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                        </ul>
                                    </div>
                                    <p>{{ $room->description }}.</p>
                                    <ul class="more-details clearfix">
                                        <li><i class="icon-14"></i>{{ $room->bed_count }} Beds</li>
                                        <li><i class="icon-15"></i>2 Baths</li>
                                        <li><i class="icon-16"></i>600 Sq Ft</li>
                                    </ul>
                                    <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See
                                            Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>




        <div class="row clearfix">

            @foreach ($shortlets as $shortlet)
                @foreach ($shortlet->rooms as $room)
                    <div class="col-lg-4 col-md-6 col-sm-12 feature-block">
                        <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms"
                            data-wow-duration="1500ms">
                            <div class="inner-box">
                                <div class="image-box">
                                    <figure class="image">
                                        @if ($room->roomImages->count() > 0)
                                            {{-- Display only the first image for each room type --}}
                                            <figure class="image">
                                                <img src="{{ asset('storage/' . $room->roomImages->first()->image_path) }}"
                                                    alt="Room Image" class="featured-img">
                                            </figure>
                                        @else
                                            <figure class="image">
                                                <img src="{{ asset('frontend/assets/images/default-room.jpg') }}"
                                                    alt="Default Room Image" class="featured-img">
                                            </figure>
                                        @endif
                                    </figure>
                                    <div class="batch"><i class="icon-11"></i></div>
                                    <span class="category">Featured</span>
                                </div>
                                <div class="lower-content">
                                    <div class="author-info clearfix">
                                        <div class="author pull-left">
                                            <figure class="author-thumb"><img src="assets/images/feature/author-1.jpg"
                                                    alt=""></figure>
                                            <h6>{{ $shortlet->shortlet_name }}</h6>
                                            {{-- <ul class="rating clearfix pull-left input">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($hotel->rating >= $i)
                                                        <li><i class="icon-39"></i></li> <!-- Full star -->
                                                    @else
                                                        <li><i class="icon-40"></i></li> <!-- Empty star -->
                                                    @endif
                                                @endfor
                                            </ul> --}}
                                        </div>
                                        <div class="buy-btn pull-right"><a
                                                href="property-details.html">{{ $room->details->room_type }}</a></div>
                                    </div>
                                    <div class="title-text">
                                        <h4><a href="property-details.html">{{ $room->room_name }}</a></h4>
                                    </div>
                                    <div class="price-box clearfix">
                                        <div class="price-info pull-left">
                                            <h6>Start From</h6>
                                            <h4>
                                                @if ($room->details)
                                                    {{ '₦ ' . number_format($room->details->price_per_night, 2) }}
                                                @endif
                                            </h4>
                                        </div>
                                        <ul class="other-option pull-right clearfix">
                                            <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                            <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                        </ul>
                                    </div>
                                    <p>{{ $room->description }}.</p>
                                    <ul class="more-details clearfix">
                                        <li><i class="icon-14"></i>{{ $room->bed_count }} Beds</li>
                                        <li><i class="icon-15"></i>2 Baths</li>
                                        <li><i class="icon-16"></i>600 Sq Ft</li>
                                    </ul>
                                    <div class="btn-box"><a href="property-details.html" class="theme-btn btn-two">See
                                            Details</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach
        </div>
        <div class="more-btn centred"><a href="property-list.html" class="theme-btn btn-one">View All Listing</a></div>
    </div>
</section>
