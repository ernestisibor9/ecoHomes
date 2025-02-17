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

    @include('components.progress-tracker', ['step' => 1])


    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow p-2">
                    <div class="card-body">
                        <h3 class="card-title text-center">Step 1: Create Shortlet</h3>
                        <form action="{{ route('shortlet.store') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Shortlet Name</label>
                                <input type="text" class="form-control" id="" name="shortlet_name">
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">How many shortlet are you listing?</label>
                                <input type="number" class="form-control" id="" name="number_of_shortlet">
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Do you allow children?</label>
                                <select id="inputState" class="form-select see" name="children">
                                    <option selected>Choose...</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Do you allow pets?</label>
                                <select id="inputState" class="form-select see" name="pet">
                                    <option selected>Choose...</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Connect to a channel manager</label>
                                <select id="inputState" class="form-select see" name="channel_manager">
                                    <option selected>Choose...</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">What languages do you or your staff
                                    speak?</label>
                                <select id="inputState" class="form-select see" name="language">
                                    <option selected>Choose...</option>
                                    <option value="english">English</option>
                                    <option value="french">French</option>
                                    <option value="italian">Italian</option>
                                    <option value="russia">Russian</option>
                                    <option value="spanish">Spanish</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Country <span class="text-danger"> *
                                    </span></label>
                                <select name="country_id"
                                    class="form-control see
                                     @error('country_id')is-invalid @enderror "
                                    required style="display: block">
                                    <option value="">Select Country</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6" id="select-state-group" style="display: none;">
                                <label for="">State/County <span class="text-danger"> *
                                    </span></label>
                                <select name="state_id"
                                    class="form-control see
                                    @error('state_id')is-invalid @enderror "
                                    required style="display: block" value="{{ old('state_id') }}">
                                    {{-- <option value="">Select State</option> --}}
                                </select>
                                @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6" id="select-city-group" style="display: none;">
                                <label for="">City/Town <span class="text-danger"> *
                                    </span></label>
                                <select name="city_id" class="form-control see" required style="display: block"
                                    value="{{ old('city_id') }}">
                                    {{-- <option value="">Select City</option> --}}
                                </select>
                            </div>
                            <div class="col-md-6" id="postal-code-group" style="display: none;">
                                <label for="">Postal Code <span class="text-danger"> *
                                    </span></label>
                                <input type="text" class="form-control" name="postal_code"
                                    placeholder="Enter your postal code" value="{{ old('postal_code') }}">
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Where is the property you're listing?</label>
                                <textarea class="form-control" id="address" rows="3" name="address" required></textarea>
                            </div>
                            {{-- <div class="col-md-6">
                                <label for="inputState" class="form-label">Postal Code</label>
                                <input type="text" class="form-control" id="" name="postal_code">
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Zip Code</label>
                                <input type="text" class="form-control" id="" name="zip_code">
                            </div> --}}
                            <div class="col-md-12">
                                <label class="form-label">Guest Facilities</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="WiFi">
                                            <label class="form-check-label" for="wifi">WiFi</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="parking"
                                                name="guest_facilities[]" value="Parking">
                                            <label class="form-check-label" for="parking">Parking</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="pool"
                                                name="guest_facilities[]" value="Swimming Pool">
                                            <label class="form-check-label" for="pool">Swimming Pool</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="gym"
                                                name="guest_facilities[]" value="Gym">
                                            <label class="form-check-label" for="gym">Gym</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="spa"
                                                name="guest_facilities[]" value="Spa">
                                            <label class="form-check-label" for="spa">Spa</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="restaurant"
                                                name="guest_facilities[]" value="Restaurant">
                                            <label class="form-check-label" for="restaurant">Restaurant</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Room service">
                                            <label class="form-check-label" for="room service">Room service</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Bar">
                                            <label class="form-check-label" for="bar">Bar</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Fitness center">
                                            <label class="form-check-label" for="fitness center">Fitness center</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Air conditioning">
                                            <label class="form-check-label" for="fitness center">Air conditioning</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Swimming pool">
                                            <label class="form-check-label" for="fitness center">Swimming pool</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="wifi"
                                                name="guest_facilities[]" value="Family rooms">
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
                                <a href="{{ url('/') }}"
                                    class="theme-btn btn-one bg-danger text-decoration-none mr-5" id="backButton">Back</a>
                                <button class="theme-btn btn-one" type="submit" id="nextButton">Next</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
        $(document).ready(function() {
            $('#multiImg').on('change', function() { //on file input change
                if (window.File && window.FileReader && window.FileList && window
                    .Blob) //check File API supported browser
                {
                    var data = $(this)[0].files; //this file data

                    $.each(data, function(index, file) { //loop though each file
                        if (/(\.|\/)(gif|jpeg|png|webp)$/i.test(file
                                .type)) { //check supported file type
                            var fRead = new FileReader(); //new filereader
                            fRead.onload = (function(file) { //trigger function on successful read
                                return function(e) {
                                    var img = $('<img/>').addClass('thumb').attr('src',
                                            e.target.result).width(100)
                                        .height(80); //create image element
                                    $('#preview_img').append(
                                        img); //append image to output element
                                };
                            })(file);
                            fRead.readAsDataURL(file); //URL representing the file's data.
                        }
                    });

                } else {
                    alert("Your browser doesn't support File API!"); //if File API is absent
                }
            });
        });
    </script>

    <script>
        const textarea = document.getElementById('description');
        const wordCountMessage = document.getElementById('wordCountMessage');
        const wordCountDisplay = document.getElementById('wordCountDisplay');

        textarea.addEventListener('input', () => {
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            const wordCount = words.length;

            // Display word count
            wordCountDisplay.textContent = `Word Count: ${wordCount}`;

            // Signal if words are less than 60
            if (wordCount < 60) {
                wordCountMessage.style.display = 'block';
            } else {
                wordCountMessage.style.display = 'none';
            }
        });

        document.getElementById('wordCountForm').addEventListener('submit', function(event) {
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            if (words.length < 60) {
                event.preventDefault(); // Prevent form submission
                alert('Please enter at least 32 words before submitting.');
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form'); // Select your form element
            const spinner = document.getElementById('loading-spinner');

            form.addEventListener('submit', function() {
                spinner.style.display = 'flex'; // Show the spinner (Flexbox for centering)
            });
        });

        form.addEventListener('submit', function() {
            document.querySelector('button[type="submit"]').disabled = true;
            spinner.style.display = 'flex';
        });
    </script>
@endsection
