
@extends('frontend.master')


@section('home')
        <!-- banner-style-two -->
        @include('frontend.home.hero')
        <!-- banner-style-two end -->

        <!-- about-section -->
        @include('frontend.home.about')
        <!-- about-section end -->

        <!-- feature-section -->
        @include('frontend.home.features', ['properties' => $properties, 'currency' => $currency, 'exchangeRate' => $exchangeRate])
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
@endsection
