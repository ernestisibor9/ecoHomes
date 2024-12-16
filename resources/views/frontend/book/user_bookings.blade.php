@extends('frontend.master')

@section('home')



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
                <h1>    @if ($properties->type->type_name === 'Duplex')
                    Buy Property
                @elseif($properties->type->type_name === 'Flat')
                    Rent Property
                @elseif($properties->type->type_name === 'Shortlet')
                    Book Property
                @elseif($properties->type->type_name === 'Bungalow')
                    Buy Property
                @elseif($properties->type->type_name === 'Land')
                    Buy Property
                @elseif($properties->type->type_name === 'Warehouse')
                    Rent Property
                @elseif($properties->type->type_name === 'Hotel')
                    Book Property
                @else
                    Book Now
                @endif</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>
                        @if ($properties->type->type_name === 'Duplex')
                        Buy Now
                    @elseif($properties->type->type_name === 'Flat')
                        Rent Now
                    @elseif($properties->type->type_name === 'Shortlet')
                        Book Now
                    @elseif($properties->type->type_name === 'Bungalow')
                        Buy Now
                    @elseif($properties->type->type_name === 'Land')
                        Buy Now
                    @elseif($properties->type->type_name === 'Warehouse')
                        Rent Now
                    @elseif($properties->type->type_name === 'Hotel')
                        Book Now
                    @else
                        Book Now
                    @endif
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Register Section -->
    <div class="container-fluid mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div class="card shadow p-3">
                    <h3 class="card-title text-center pt-2">
                        @if ($properties->type->type_name === 'Duplex')
                        Buy Now
                    @elseif($properties->type->type_name === 'Flat')
                        Rent Now
                    @elseif($properties->type->type_name === 'Shortlet')
                        Book Now
                    @elseif($properties->type->type_name === 'Bungalow')
                        Buy Now
                    @elseif($properties->type->type_name === 'Land')
                        Buy Now
                    @elseif($properties->type->type_name === 'Warehouse')
                        Rent Now
                    @elseif($properties->type->type_name === 'Hotel')
                        Book Now
                    @else
                        Book Now
                    @endif
                    </h3>
                    <div class="card-body">
                        <form action="{{route('store.booking')}}" method="post">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">User's Name</label>
                                    <input type="name"
                                        class="form-control"
                                        readonly aria-label="Name" name="name"
                                        required  value="{{$userData->name}}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Email</label>
                                    <input type="email"
                                        class="form-control"
                                        readonly aria-label="Email" name="email"
                                        required  value="{{$userData->email}}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Phone Number</label>
                                    <input type="name"
                                        class="form-control"
                                        readonly aria-label="Phone" name="phone"
                                        required  value="{{$userData->phone}}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Property Name</label>
                                    <input type="email"
                                        class="form-control"
                                        readonly aria-label="Property Name" name="property_name"
                                        required  value="{{$properties->property_name}}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Property Type</label>
                                    <input type="name"
                                        class="form-control"
                                        readonly aria-label="Property Type" name="property_type"
                                        required  value="{{$properties->type->type_name}}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Property ID</label>
                                    <input type="email"
                                        class="form-control"
                                        readonly aria-label="Property ID" name="property_code"
                                        required  value="{{$properties->property_code}}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Country</label>
                                    <input type="name"
                                        class="form-control"
                                        readonly aria-label="Country" name="country"
                                        required  value="{{$properties->country->name}}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">State/County</label>
                                    <input type="email"
                                        class="form-control"
                                        readonly aria-label="State" name="state"
                                        required  value="{{$properties->state->name}}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">City</label>
                                    <input type="name"
                                        class="form-control"
                                        readonly aria-label="City" name="city"
                                        required  value="{{$properties->city->name}}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Price</label>
                                    <input type="email"
                                        class="form-control"
                                        readonly aria-label="Price" name="price"
                                        required  value="{{$properties->price}}">
                                </div>
                            </div>
                            <div class="d-grid gap-2 form-group message-btn">
                                <button class="theme-btn btn-one" type="submit" id="nextButton">
                                    @if ($properties->type->type_name === 'Duplex')
                                    Buy Now
                                    @elseif($properties->type->type_name === 'Flat')
                                    Rent Now
                                    @elseif($properties->type->type_name === 'Shortlet')
                                    Book Now
                                    @elseif($properties->type->type_name === 'Bungalow')
                                    Buy Now
                                    @elseif($properties->type->type_name === 'Land')
                                    Buy Now
                                    @elseif($properties->type->type_name === 'Warehouse')
                                    Rent Now
                                    @elseif($properties->type->type_name === 'Hotel')
                                    Book Now
                                    @else
                                    Book Now
                                    @endif
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Section End -->
@endsection
