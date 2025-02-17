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
                        <h3 class="card-title text-center">LIST YOUR PROPERTY</h3>
                        <form action="{{ route('store.land') }}" method="POST" class="row g-3"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Property Title</label>
                                <input type="text" class="form-control  @error('property_title')is-invalid @enderror "
                                    id="" name="property_title" placeholder="Plot of Land for Sale in Lagos"
                                    value="{{ old('property_title') }}">
                                @error('property_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Types of Land</label>
                                <select id="inputState"
                                    class="form-select @error('property_variant')is-invalid @enderror see"
                                    name="property_variant" value="{{ old('property_variant') }}">
                                    <option selected>Choose...</option>
                                    <option value="Residential">Residential</option>
                                    <option value="Commercial">Commercial</option>
                                    <option value=" Industrial"> Industrial</option>
                                    <option value="Agricultural">Agricultural</option>
                                    <option value="Mixed-Use">Mixed-Use</option>
                                </select>
                                @error('property_variant')
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
                                <label for="inputState" class="form-label">Topography</label>
                                <select id="inputState"
                                    class="form-select @error('topography')is-invalid @enderror see"
                                    name="topography" value="{{ old('topography') }}">
                                    <option selected>Choose...</option>
                                    <option value="Flat">Flat</option>
                                    <option value="Sloppy">Sloppy</option>
                                    <option value="Hilly">Hilly</option>
                                    <option value="Rocky">Rocky</option>
                                </select>
                                @error('topography')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Availability of Road Acess</label>
                                <select id="inputState"
                                    class="form-select @error('road_access')is-invalid @enderror see"
                                    name="road_access" value="{{ old('road_access') }}">
                                    <option selected>Choose...</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                                @error('road_access')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Fencing</label>
                                <select id="inputState"
                                    class="form-select @error('fencing')is-invalid @enderror see"
                                    name="fencing" value="{{ old('fencing') }}">
                                    <option selected>Choose...</option>
                                    <option value="Fenced">Fenced</option>
                                    <option value="Partially Fenced">Partially Fenced</option>
                                    <option value="Not Fenced">Not Fenced</option>
                                </select>
                                @error('fencing')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Size/Area</label>
                                <input type="text" class="form-control @error('size')is-invalid @enderror"
                                    id="" name="size" value="{{ old('size') }}"
                                    placeholder="e.g., 500 sqm, 1 acre, 10 hectares">
                                @error('size')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Drainage System</label>
                                <select id="inputState"
                                    class="form-select @error('drainage_system')is-invalid @enderror see"
                                    name="drainage_system" value="{{ old('drainage_system') }}">
                                    <option selected>Choose...</option>
                                    <option value="Fully Furnished">Good</option>
                                    <option value="Semi-Furnished">Poor</option>
                                    <option value="Unfurnished">Not Available</option>
                                </select>
                                @error('drainage_system')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Flood Risk</label>
                                <select id="inputState"
                                    class="form-select @error('flood_risk')is-invalid @enderror see"
                                    name="flood_risk" value="{{ old('flood_risk') }}">
                                    <option selected>Choose...</option>
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                                @error('flood_risk')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            {{-- <div class="col-md-6" id="price_per_annum_group">
                                <label for="price_per_annum" class="form-label">Price Per Annum</label>
                                <input type="number" class="form-control @error('price_per_annum')is-invalid @enderror"
                                    id="price_per_annum" name="price_per_annum" value="{{ old('price_per_annum') }}" min="0">
                                @error('price_per_annum')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div> --}}

                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Owner Phone No.</label>
                                <input type="text" class="form-control @error('owner_phone')is-invalid @enderror"
                                    id="" name="owner_phone" value="{{ old('owner_phone') }}">
                                @error('owner_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="inputEmail4" class="form-label">Owner Name</label>
                                <input type="text" class="form-control @error('owner_name')is-invalid @enderror"
                                    id="" name="owner_name" value="{{ old('owner_name') }}">
                                @error('owner_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Utilities</label>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="parking"
                                                name="guest_facilities[]" value="Parking">
                                            <label class="form-check-label" for="parking">Parking</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="gym"
                                                name="guest_facilities[]" value="Security_Guard">
                                            <label class="form-check-label" for="gym">Security</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="restaurant"
                                                name="guest_facilities[]" value="Electricity_Supply">
                                            <label class="form-check-label" for="restaurant">Electricity</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6" id="price_group" style="display: none;">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" class="form-control @error('price')is-invalid @enderror"
                                    id="price" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-8">
                                <label for="">Upload Photo <span class="text-danger">(max: 2MB)</span></label>
                                <input type="file"
                                    class="form-control-file   @error('property_thumbnail')is-invalid @enderror"
                                    name="property_thumbnail" onChange="mainThamUrl(this)">
                                @error('property_thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <img src="" id="mainThmb">
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="">Upload Multiple Photos <span class="text-danger">(max:
                                        2MB)</span></label>
                                <input type="file"
                                    class="form-control-file  @error('multi_photo_name')is-invalid @enderror" multiple
                                    name="multi_photo_name[]" id="multiImg">
                                @error('multi_photo_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                <div class="col-md-6">
                                    <div class="row" id="preview_img"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
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
                                <label for="inputState" class="form-label">Address</label>
                                <textarea class="form-control @error('address')is-invalid @enderror " id="description" rows="3"
                                    name="address" value="{{ old('address') }}"></textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Property Description</label>
                                <textarea class="form-control @error('description')is-invalid @enderror " id="description" rows="3"
                                    name="description" value="{{ old('description') }}"></textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="{{ url('/') }}"
                                    class="theme-btn btn-one bg-danger text-decoration-none mr-5" id="backButton">Back</a>
                                <button class="theme-btn btn-one" type="submit">Submit</button>
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


@endsection
