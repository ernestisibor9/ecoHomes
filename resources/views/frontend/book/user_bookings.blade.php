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
                <h1>
                    @if ($properties->property_status === 'buy')
                        Buy Now
                    @elseif($properties->property_status === 'rent')
                        Rent Now
                    @elseif($properties->property_status === 'lease')
                        Lease Now
                    @else
                        Book Now
                    @endif
                </h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>
                        @if ($properties->property_status === 'buy')
                            Buy Now
                        @elseif($properties->property_status === 'rent')
                            Rent Now
                        @elseif($properties->property_status === 'lease')
                            Lease Now
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
            @if (session('message'))
                <div class="alert alert-{{ session('status') == 'success' ? 'success' : 'danger' }} alert-dismissible fade show"
                    role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-9">
                <div class="card shadow p-3">
                    <h3 class="card-title text-center pt-2">
                        Request Viewing
                    </h3>
                    <p>
                        @php

                            $availabilities = App\Models\Availability::where(
                                'property_id',
                                $properties->id,
                            )->first();
                        @endphp
                        @if ($availabilities)
                            <div class="alert alert-success" role="alert">
                                Available date for inspection:
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
                    </p>
                    <div class="card-body">
                        <form action="{{ route('viewing.request', $properties->id) }}" method="post">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="requested_time" class="form-label">Select Date</label>
                                    <input type="date" name="requested_date" id="requested_date" class="form-control"
                                        required>
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="requested_time" class="form-label">Select Time</label>
                                    <input type="time" name="requested_time" id="requested_time" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Seller's Name</label>
                                    <input type="name" class="form-control" readonly aria-label="Name" name="name"
                                        required value="{{ $properties->seller->firstname }}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Seller's Email</label>
                                    <input type="email" class="form-control" readonly aria-label="Email" name="email"
                                        required value="{{ $properties->seller->email }}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Seller's Phone Number</label>
                                    <input type="name" class="form-control" readonly aria-label="Phone" name="phone"
                                        required value="{{ $properties->seller->phone }}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Property Name</label>
                                    <input type="email" class="form-control" readonly aria-label="Property Name"
                                        name="property_name" required value="{{ $properties->property_name }}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Property Type</label>
                                    <input type="name" class="form-control" readonly aria-label="Property Type"
                                        name="property_type" required value="{{ $properties->type->type_name }}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Property ID</label>
                                    <input type="email" class="form-control" readonly aria-label="Property ID"
                                        name="property_code" required value="{{ $properties->property_code }}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Country</label>
                                    <input type="name" class="form-control" readonly aria-label="Country" name="country"
                                        required value="{{ $properties->country->name }}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">State/County</label>
                                    <input type="email" class="form-control" readonly aria-label="State" name="state"
                                        required value="{{ $properties->state->name }}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">City</label>
                                    <input type="name" class="form-control" readonly aria-label="City" name="city"
                                        required value="{{ $properties->city->name }}">
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Price</label>
                                    <input type="email" class="form-control" readonly aria-label="Price"
                                        name="price" required value="{{ number_format($properties->price) }}">
                                </div>
                            </div>
                            <div class="d-grid gap-2 form-group message-btn">
                                <button class="theme-btn btn-one" type="submit" id="nextButton">
                                    Request Viewing
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Section End -->

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
@endsection
