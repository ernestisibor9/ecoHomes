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

    <style>
        .rating {
            display: flex;
            flex-direction: row-reverse;
            justify-content: center;
        }

        .rating input {
            display: none;
        }

        .rating label {
            font-size: 2rem;
            color: lightgray;
            cursor: pointer;
        }

        .rating input:checked~label {
            color: gold;
        }

        .rating label:hover,
        .rating label:hover~label {
            color: gold;
        }
    </style>


    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow p-2">
                    <div class="card-body">
                        <h3 class="card-title text-center">REQUEST DETAILS</h3>
                        <form action="{{ route('store.request.property') }}" method="POST" class="row g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Name</label>
                                <input type="text" class="form-control  @error('name')is-invalid @enderror "
                                    id="" name="name" placeholder="Your Name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Email</label>
                                <input type="text" class="form-control  @error('email')is-invalid @enderror "
                                    id="" name="email" placeholder="Your Email Address"
                                    value="{{ old('email') }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Phone</label>
                                <input type="text" class="form-control  @error('phone')is-invalid @enderror "
                                    id="" name="phone" placeholder="Your Phone Number"
                                    value="{{ old('phone') }}">
                                @error('phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Property Type</label>
                                <select id="inputState"
                                    class="form-select @error('property_type')is-invalid @enderror see"
                                    name="property_type" value="{{ old('property_type') }}">
                                    <option selected>Choose...</option>
                                    <option value="Flat">Flat</option>
                                    <option value="House">House</option>
                                    <option value="Land">Land</option>
                                    <option value="Commercial Property">Commercial Property</option>
                                </select>
                                @error('property_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Property Status</label>
                                <select id="inputState"
                                    class="form-select @error('property_status')is-invalid @enderror see"
                                    name="property_status" value="{{ old('property_status') }}">
                                    <option selected>Choose...</option>
                                    <option value="rent">For Rent</option>
                                    <option value="lease">For Lease</option>
                                    <option value="sell">For Sell</option>
                                </select>
                                @error('property_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Bedroom (optional)</label>
                                <input type="number" class="form-control @error('bedroom')is-invalid @enderror"
                                    id="" name="bedroom" value="{{ old('bedroom') }}" min="0">
                                @error('bedroom')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">I am a/an ...</label>
                                <select id="inputState"
                                    class="form-select @error('person')is-invalid @enderror see"
                                    name="person" value="{{ old('person') }}">
                                    <option selected>Choose...</option>
                                    <option value="Individual">Individual</option>
                                    <option value="Agent">Agent</option>
                                    <option value="Developer">Developer</option>
                                </select>
                                @error('person')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Budget</label>
                                <input type="number" class="form-control @error('budget')is-invalid @enderror"
                                    id="" name="budget" value="{{ old('budget') }}">
                                @error('budget')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Country <span class="text-danger"> *
                                    </span></label>
                                <select name="country_id"
                                    class="form-control see
                                     @error('country_id')is-invalid @enderror "
                                    style="display: block">
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
                                    style="display: block" value="{{ old('state_id') }}">
                                    {{-- <option value="">Select State</option> --}}
                                </select>
                                @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6" id="select-city-group" style="display: none;">
                                <label for="">City/Town <span class="text-danger"> *
                                    </span></label>
                                <select name="city_id" class="form-control see" style="display: block"
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
                                <label for="inputState" class="form-label">Comment</label>
                                <textarea class="form-control @error('comment')is-invalid @enderror " id="description" rows="3"
                                    name="comment" value="{{ old('comment') }}"></textarea>
                                @error('comment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center">
                                <a href="{{ url('/') }}"
                                    class="theme-btn btn-one bg-danger text-decoration-none mr-5" id="backButton">Back</a>
                                <button class="theme-btn btn-one" type="submit">Create Request</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        function mainThamUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#mainThmb').attr('src', e.target.result).width(130).height(110);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

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

    {{-- <script>
    document.addEventListener("DOMContentLoaded", function () {
        let propertyStatus = document.querySelector("select[name='property_status']");
        let pricePerAnnumGroup = document.getElementById("price_per_annum_group");
        let priceGroup = document.getElementById("price_group");

        function togglePriceFields() {
            console.log("Selected Value:", propertyStatus.value); // Debugging log

            if (propertyStatus.value.trim().toLowerCase() === "sell") {
                pricePerAnnumGroup.style.display = "none";
                priceGroup.style.display = "block";
            } else {
                pricePerAnnumGroup.style.display = "block";
                priceGroup.style.display = "none";
            }
        }

        // Run function on change
        propertyStatus.addEventListener("change", togglePriceFields);

        // Run function on page load (to handle old values)
        togglePriceFields();
    });
</script> --}}

{{-- <script>
    function getCoordinates() {
        var addressInput = document.querySelector("textarea[name='address']");
        var countrySelect = document.querySelector("select[name='country_id']");
        var stateSelect = document.querySelector("select[name='state_id']");
        var citySelect = document.querySelector("select[name='city_id']");

        var latitudeInput = document.querySelector("input[name='latitude']");
        var longitudeInput = document.querySelector("input[name='longitude']");

        if (!addressInput || !countrySelect || !latitudeInput || !longitudeInput) {
            console.error("One or more required elements are missing.");
            return;
        }

        var address = addressInput.value.trim();
        var country = countrySelect.selectedOptions[0]?.text || '';
        var state = stateSelect?.selectedOptions[0]?.text || '';
        var city = citySelect?.selectedOptions[0]?.text || '';

        var fullAddress = `${address}, ${city}, ${state}, ${country}`.trim();
        console.log("Fetching coordinates for:", fullAddress);

        fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(fullAddress)}&key=
AIzaSyCyjXnqsGiPVQlBnK_ZT082tIy1wvppC6o`)
            .then(response => response.json())
            .then(data => {
                console.log("Google Maps API Response:", data);

                if (data.status === "OK" && data.results.length > 0) {
                    var location = data.results[0].geometry.location;
                    latitudeInput.value = location.lat;
                    longitudeInput.value = location.lng;
                } else {
                    alert("Could not find location. Please enter a valid address.");
                }
            })
            .catch(error => console.error("Error fetching coordinates:", error));
    }

    // Attach event listeners to all relevant input fields
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelector("textarea[name='address']").addEventListener("change", getCoordinates);
        document.querySelector("select[name='country_id']").addEventListener("change", getCoordinates);
        document.querySelector("select[name='state_id']").addEventListener("change", getCoordinates);
        document.querySelector("select[name='city_id']").addEventListener("change", getCoordinates);
    });

    // Dummy initMap function to prevent Google Maps API errors
    function initMap() {
        console.log("Google Maps API Loaded Successfully");
    }
</script>

<!-- Load Google Maps API -->
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap">
</script> --}}

@endsection
