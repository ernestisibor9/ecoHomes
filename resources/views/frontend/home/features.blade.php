@php

@endphp


<style>
    .featured-img {
        width: 370px !important;
        height: 250px !important;
        object-fit: cover;
        transition: transform 0.3s ease;
    }
</style>

<section class="feature-section alternate-2 sec-pad">
    <div class="auto-container">
        <div class="sec-title centred">
            <h5>Features</h5>
            <h2>Featured Property</h2>
            <p>Experience the pinnacle of modern living with our Featured Property, a masterpiece designed <br /> to
                harmonize comfort, luxury, and sustainability.</p>
        </div>
        <div class="row clearfix">
            @foreach ($properties as $item)
                <div class="col-lg-4 col-md-6 col-sm-12 feature-block mb-4">
                    <div class="feature-block-one wow fadeInUp animated" data-wow-delay="00ms" data-wow-duration="1500ms">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="{{ asset($item->property_thumbnail) }}" alt=""
                                        class="featured-img"></figure>
                                <div class="batch"><i class="icon-11"></i></div>
                                <span class="category">Featured</span>
                            </div>
                            <div class="lower-content">
                                <div class="author-info clearfix">
                                    <div class="author pull-left">
                                        <figure class="author-thumb"><img
                                                src="{{ asset('frontend/assets/images/feature/author-1.jpg') }}"
                                                alt=""></figure>
                                        <h6>Admin</h6>
                                    </div>
                                    <div class="buy-btn pull-right"><a
                                            href="property-details.html">{{ $item->property_status }} Now</a></div>
                                </div>
                                <div class="title-text">
                                    <h4><a href="property-details.html">{{ $item->property_name }}</a></h4>
                                </div>
                                <div class="price-box clearfix">
                                    <div class="price-info pull-left">
                                        <h6>Price</h6>
                                        <h4>
                                            @if ($currency == 'NGN')
                                                {{ '₦ ' . number_format($item->price, 2) }}
                                                <!-- Display price in NGN -->
                                            @else
                                                {{ $currency . ' ' . number_format($item->price_converted, 2) }}
                                                <!-- Display converted price -->
                                            @endif
                                        </h4>
                                    </div>
                                    <ul class="other-option pull-right clearfix">
                                        <li><a href="property-details.html"><i class="icon-12"></i></a></li>
                                        <li><a href="property-details.html"><i class="icon-13"></i></a></li>
                                    </ul>
                                </div>
                                <p>{{ substr($item->long_description, 0, 52) }}</p>
                                <ul class="more-details clearfix">
                                    <li><i class="icon-14"></i>{{ $item->bedrooms }} Beds</li>
                                    <li><i class="icon-15"></i>{{ $item->bathrooms }} Baths</li>
                                    <li><i class="icon-16"></i>600 Sq Ft</li>
                                </ul>
                                <div class="btn-box"><a href="{{ url('property/details/' . $item->id . '/' . $item->property_slug) }}" class="theme-btn btn-two">See
                                        Details</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="more-btn centred"><a href="property-list.html" class="theme-btn btn-one">View All Listing</a></div>
    </div>
</section>
