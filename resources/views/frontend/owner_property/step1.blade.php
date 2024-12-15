@extends('frontend.master')

@section('home')
   @php
        $propertyTypes = App\Models\PropertyType::orderBy('type_name', 'asc')->get();
   @endphp
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
    .progress {
        height: 20px;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-custom {
        background: linear-gradient(to right, #4caf50, #81c784);
        /* Green gradient */
        color: white;
        font-weight: bold;
    }
</style>

<style>
    #loading-spinner {
        display: none; /* Hidden by default */
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent overlay */
        z-index: 1000;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>



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
                <h1>Sell Property</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Market Property</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Register Section -->
    <div class="container-fluid mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">
                {{-- <div class="progress">
                    <div class="progress-bar" id="progressBar" style="width: {{ ($currentStep / 4) * 100 }}%;">
                        {{ ($currentStep / 4) * 100 }}% Complete</div>
                </div> --}}

                <div class="card shadow p-3">
                    <div class="progress mt-2 mb-3">
                        <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 25%;"
                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                    </div>
                    <p class="text-dark">Current Step: 1/4</p>
                    <h3 class="card-title text-center pt-2">FILL THE FORM TO MARKET YOUR PROPERTY</h3>
                    <div class="card-body">
                        <form action="{{route('form.submit1')}}" id="wordCountForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">FirstName <span class="text-danger"> *
                                    </span></label>
                                    <input type="text"
                                        class="form-control
                                    @error('firstname')is-invalid @enderror"
                                        placeholder="First Name" aria-label="First name"
                                        required name="firstname"  value="{{ old('firstname') }}">
                                    @error('firstname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">LastName <span class="text-danger"> *
                                    </span></label>
                                    <input type="text"
                                        class="form-control
                                    @error('lastname')is-invalid @enderror"
                                        placeholder="Last Name" aria-label="Last name"
                                        name="lastname" required  value="{{ old('lastname') }}">
                                    @error('lastname')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <label for="">Property Name <span class="text-danger"> *
                                    </span></label>
                                    <input type="text"
                                        class="form-control
                                    @error('property_name')is-invalid @enderror"
                                        placeholder="Property Name" aria-label="property_name"
                                        required name="property_name"  value="{{ old('property_name') }}">
                                    @error('property_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Price <span class="text-danger"> *
                                    </span></label>
                                    <input type="text"
                                        class="form-control
                                    @error('lowest_price')is-invalid @enderror"
                                        placeholder="Price" aria-label="lowest_price"
                                        required name="lowest_price"  value="{{ old('lowest_price') }}">
                                    @error('lowest_price')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Property Type <span class="text-danger"> *
                                    </span></label>
                                    <select name="property_id"
                                        class="form-control see
                                     @error('property_id')is-invalid @enderror "
                                        required style="display: block">
                                        <option value="">Select Property</option>
                                        @foreach ($propertyTypes as $propertyType)
                                            <option value="{{ $propertyType->id }}"
                                                {{ old('property_id') == $propertyType->id ? 'selected' : '' }}>{{ $propertyType->type_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('property_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Video <span class="text-danger">
                                    </span> <span class="text-danger">(The video resolution must be at least 1920x1080)</span></label>
                                    <input type="file" class="form-control see @error('video')is-invalid @enderror"
                                            name="video" id="" accept="video/mp4, video/mkv, video/avi"
                                             value="{{ old('video') }}">
                                    @error('video')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6">
                                    <label for="">Email <span class="text-danger"> *
                                    </span></label>
                                    <input type="email"
                                        class="form-control
                                     @error('email')is-invalid @enderror"
                                        placeholder="Email" aria-label="Email" name="email"
                                        required  value="{{ old('email') }}">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6">
                                    <label for="">Phone <span class="text-danger"> *
                                    </span></label>
                                    <input type="text"
                                        class="form-control
                                    @error('phone')is-invalid @enderror "
                                        placeholder="Phone" aria-label="Phone"
                                        name="phone" required  value="{{ old('phone') }}">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <label for="" class="mt-2">Enter Amenities (separated by commas):  <span class="text-danger"> *
                                </span>
                                </label>
                                <textarea class="form-control" id="amenities" rows="3"
                                 name="amenities" required >{{ old('amenities') }}</textarea>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label for="">Upload Photos <span class="text-danger"> *
                                    </span><span class="text-danger">(max_size: 1MB, file type:
                                            jpeg,png,jpg,gif)
                                        </span></label>
                                    <input type="file" name="multi_img[]"
                                        class="form-control
                                     @error('multi_img.*')is-invalid @enderror"
                                        id="multiImg" multiple
                                         required>
                                    @error('multi_img.*')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <div class="mb-2 mt-2">
                                        <div class="row" id="preview_img"></div>
                                    </div>
                                </div>

                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12">
                                    <label for="">Country <span class="text-danger"> *
                                    </span></label>
                                    <select name="country_id"
                                        class="form-control see
                                     @error('country_id')is-invalid @enderror "
                                        required style="display: block"
                                       >
                                        <option value="">Select Country</option>
                                        @foreach ($countries as $country)
                                            <option value="{{ $country->id }}"
                                                >{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('country_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12 col-md-6" id="select-state-group" style="display: none;">
                                    <label for="">State/County <span class="text-danger"> *
                                    </span></label>
                                    <select name="state_id"
                                        class="form-control see
                                    @error('state_id')is-invalid @enderror "
                                        required style="display: block"
                                        value="{{ old('state_id') }}">
                                        {{-- <option value="">Select State</option> --}}
                                    </select>
                                    @error('state_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-12 col-md-6" id="select-city-group" style="display: none;">
                                    <label for="">City/Town <span class="text-danger"> *
                                    </span></label>
                                    <select name="city_id" class="form-control see" required
                                    style="display: block"  value="{{ old('city_id') }}">
                                        {{-- <option value="">Select City</option> --}}
                                    </select>
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <div class="col-12" id="postal-code-group" style="display: none;">
                                    <label for="">Postal Code <span class="text-danger"> *
                                    </span></label>
                                    <input type="text" class="form-control" name="postal_code"
                                        placeholder="Enter your postal code"
                                        value="{{ old('postal_code') }}">
                                </div>
                            </div>
                            <div class="row g-3 mb-3">
                                <label for="" class="mt-2">Address
                                    <span class="text-danger"> *
                                    </span>
                                </label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2"
                                name="address" required  >{{ old('address') }}</textarea>
                            </div>
                            <div class="row g-3 mb-3">
                                <label for="" class="mt-2">Property Description <span class="text-danger"> *
                                </span>
                                    <p class="text-danger" id="wordCountMessage" style="color: red; display: none;">
                                        Your content must be at least 32 words.
                                    </p>
                                    <p id="wordCountDisplay"></p>
                                </label>
                                <textarea class="form-control" id="description" rows="3" name="long_description"
                                 required  >{{ old('long_description') }}</textarea>
                            </div>
                            <div class="row g-3 mb-3">
                                {{-- <div class="form-group message-btn">
                                    <button type="submit" class="theme-btn btn-one">Sell</button>
                                </div> --}}
                                <div class="d-grid gap-2 form-group message-btn">
                                    <button class="theme-btn btn-one" type="submit" id="nextButton">Submit</button>
                                </div>
                            </div>
                        </form>
                        <!-- Spinner -->
<div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1000; justify-content: center; align-items: center;">
    <img src="{{ asset('spinner.gif') }}" alt="Loading..." style="width: 100px; height: 100px;">
</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Section End -->

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

        document.getElementById('wordCountForm').addEventListener('submit', function (event) {
            const words = textarea.value.trim().split(/\s+/).filter(word => word.length > 0);
            if (words.length < 60) {
                event.preventDefault(); // Prevent form submission
                alert('Please enter at least 100 words before submitting.');
            }
        });
    </script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form'); // Select your form element
        const spinner = document.getElementById('loading-spinner');

        form.addEventListener('submit', function () {
            spinner.style.display = 'flex'; // Show the spinner (Flexbox for centering)
        });
    });

    form.addEventListener('submit', function () {
    document.querySelector('button[type="submit"]').disabled = true;
    spinner.style.display = 'flex';
});

</script>

@endsection
