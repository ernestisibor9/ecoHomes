@extends('frontend.master')


@section('home')
    <!-- banner-style-two -->
    @include('frontend.home.hero')
    <!-- banner-style-two end -->

    <!-- banner-style-two -->
    @include('frontend.home.features_property', ['listProperties' => $listProperties])
    <!-- banner-style-two end -->

    <div id="loading" class="text-center mt-3" style="display: none;">
        <p>Loading more properties...</p>
    </div>

    <!-- about-section -->
    {{-- @include('frontend.home.about') --}}
    <!-- about-section end -->

    <!-- feature-section -->
    {{-- @include('frontend.home.features', [
        'properties' => $properties,
        'currency' => $currency,
        'exchangeRate' => $exchangeRate,
    ]) --}}
    <!-- feature-section end -->

    <!-- feature-style-three -->
    @include('frontend.home.services')
    <!-- feature-style-three end -->

    <!-- cta-section -->
    @include('frontend.home.buy_sell')
    <!-- cta-section end -->


    <!-- testimonial-style-four -->
    @include('frontend.home.testimonial')
    <!-- testimonial-style-four end -->


    <!-- news-style-two -->
    @include('frontend.home.news_articles')
    <!-- news-style-two end -->


    <!-- contact-section -->
    @include('frontend.home.contact')
    <!-- contact-section end -->

    <script>
        $(document).ready(function () {
            let page = 1;
            let isLoading = false;

            $(window).scroll(function () {
                if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100 && !isLoading) {
                    isLoading = true;
                    page++;
                    loadMoreProperties(page);
                }
            });

            function loadMoreProperties(page) {
                $("#loading").show();

                $.ajax({
                    url: "{{ route('index') }}?page=" + page,  // Updated the URL
                    type: 'get',
                    dataType: 'html',
                    beforeSend: function () {
                        console.log("Loading page " + page);
                    }
                })
                .done(function (data) {
                    if (data.trim() === "") {
                        console.log("No more properties to load.");
                        $("#loading").html("<p>No more properties available.</p>");
                        return;
                    }

                    $("#property-list").append(data);
                    isLoading = false;
                    $("#loading").hide();
                })
                .fail(function () {
                    console.log("Failed to load properties.");
                    $("#loading").hide();
                });
            }
        });
    </script>


@endsection
