@extends('frontend.master')


@section('home')
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-8">
                <video autoplay muted loop class="w-100" style="height: 350px; object-fit: cover;">
                    <source src="{{ asset('frontend/assets/videos/building.mp4') }}" type="video/mp4">
                </video>
            </div>
            <div class="col-md-4 d-flex flex-column gy-5">
                <a href="{{route('sell.my.property.details')}}" class="btn btn-success rounded-pill mb-4 p-2">Sell My Property</a>
                <a href="{{route('sell.my.property')}}" class="btn btn-success rounded-pill mb-4 p-2">Advertise My Property</a>
                <a href="{{route('book.my.property.details')}}" class="btn btn-success rounded-pill mb-4 p-2">Book A Property</a>
                {{-- <a href="{{route('next.form.route',  ['step' => 1])}}" class="btn btn-primary rounded-pill mb-4 p-2">Sell My Property</a>
                <a href="{{route('form.step1')}}" class="btn btn-danger rounded-pill mb-4 p-2">Sell My Property</a> --}}
            </div>




        </div>
    </div>
@endsection
