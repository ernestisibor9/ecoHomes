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
    </style>

    @include('components.progress-tracker', ['step' => 1])


    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow p-2">
                    <div class="card-body">
                        <h3 class="card-title text-center">Step 1: Create Hotel</h3>
                        <form action="{{ route('hotel.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Hotel Name</label>
                                <input type="text" class="form-control" id="" name="hotel_name">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">How many hotels are you listing?</label>
                                <input type="number" class="form-control" id="" name="number_of_hotels">
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Do you allow children?</label>
                                <select id="inputState" class="form-select" name="children">
                                    <option selected>Choose...</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Do you allow pets?</label>
                                <select id="inputState" class="form-select" name="pet">
                                    <option selected>Choose...</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Connect to a channel manager</label>
                                <select id="inputState" class="form-select" name="channel_manager">
                                    <option selected>Choose...</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">What languages do you or your staff
                                    speak?</label>
                                <select id="inputState" class="form-select" name="language">
                                    <option selected>Choose...</option>
                                    <option value="english">English</option>
                                    <option value="french">French</option>
                                    <option value="italian">Italian</option>
                                    <option value="russia">Russian</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Where is the property you're listing?</label>
                                <textarea class="form-control" id="address" rows="3" name="address" required></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" id="" name="postal_code">
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="" name="zip_code">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Guest Facilities</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi" name="guest_facilities[]" value="WiFi">
                                            <label class="form-check-label" for="wifi">WiFi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="parking" name="guest_facilities[]" value="Parking">
                                            <label class="form-check-label" for="parking">Parking</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="pool" name="guest_facilities[]" value="Swimming Pool">
                                            <label class="form-check-label" for="pool">Swimming Pool</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="gym" name="guest_facilities[]" value="Gym">
                                            <label class="form-check-label" for="gym">Gym</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="spa" name="guest_facilities[]" value="Spa">
                                            <label class="form-check-label" for="spa">Spa</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="restaurant" name="guest_facilities[]" value="Restaurant">
                                            <label class="form-check-label" for="restaurant">Restaurant</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi" name="guest_facilities[]" value="Room service">
                                            <label class="form-check-label" for="room service">Room service</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi" name="guest_facilities[]" value="Bar">
                                            <label class="form-check-label" for="bar">Bar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi" name="guest_facilities[]" value="Fitness center">
                                            <label class="form-check-label" for="fitness center">Fitness center</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi" name="guest_facilities[]" value="Air conditioning">
                                            <label class="form-check-label" for="fitness center">Air conditioning</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi" name="guest_facilities[]" value="Swimming pool">
                                            <label class="form-check-label" for="fitness center">Swimming pool</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi" name="guest_facilities[]" value="Family rooms">
                                            <label class="form-check-label" for="fitness center">Family rooms</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Tell us about your hotel</label>
                                <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="{{url('/')}}" class="theme-btn btn-one bg-danger text-decoration-none mr-5" id="backButton">Back</a>
                                <button class="theme-btn btn-one" type="submit" id="nextButton">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
