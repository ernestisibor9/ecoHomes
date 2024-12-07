@extends('frontend.master')

@section('home')
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script> --}}
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

                <div class="card shadow p-3">
                    {{-- <h3 class="card-title text-center pt-2">FILL THE FORM TO SELL PROPERTY</h3> --}}
                    <div class="progress">
                        <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 50%;"
                            aria-valuenow="50
                            " aria-valuemin="0" aria-valuemax="100">50%</div>
                    </div>

                    <div class="card-body">
                        <div class="text-center" style="line-height: 30px;">
                            <h3>Verification Stage</h3>
                            <p class="text-dark"><strong>Current Step:</strong> 2/4</p>
                            <p class="text-dark"><strong>Status:</strong> {{ $progress !== null ? Str::ucfirst($progress->status) : 'User not found'}}</p>
                            <p class="text-dark">We will contact you soon</p>
                            <p class="text-dark">
                                @if ($progress->status == 'approved')
                                {{-- <a href="{{ route('form.step2') }}">Proceed to Step 3</a> --}}
                                <h6 class="text-center fw-bold">Go to</h6>
                                <div class="d-grid gap-2 form-group message-btn mt-4">
                                    <a href="{{route('terms.conditions')}}" class="theme-btn btn-one" target="_blank">
                                        Terms and Conditions</a>
                                </div>
                            @elseif($progress->status == 'rejected')
                                <p class="text-danger">Your submission has been rejected. Please contact support.</p>
                            @else
                                <p class="text-dark">Your submission is pending approval. We will contact you soon</p>
                            @endif
                            </p>
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
                        url: "{{ url('/get-states/ajax') }}/" + country_id,
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
                        url: "{{ url('/get-cities/ajax') }}/" + state_id,
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
        document.addEventListener('DOMContentLoaded', function() {
            const progressBar = document.querySelector('#progressBar');
            const totalSteps = 4; // Total number of steps
            let currentStep = {{ $currentStep ?? 1 }}; // Default to step 1 if not provided

            // Function to update the progress bar
            function updateProgressBar(step) {
                const percentage = (step / totalSteps) * 100;
                progressBar.style.width = `${percentage}%`;
                progressBar.textContent = `${Math.round(percentage)}% Complete`;

                // Add animated class for smooth transition
                progressBar.classList.add('animated');

                // Remove animation class after transition to prevent multiple triggers
                setTimeout(function() {
                    progressBar.classList.remove('animated');
                }, 500); // Match the duration of the transition
            }

            // Initial update on page load
            updateProgressBar(currentStep);

            // Handle button click to move to the next step
            const nextButton = document.querySelector('#nextButton');
            if (nextButton) {
                nextButton.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevent form submission to control flow

                    // Increment the current step (ensure it doesn't exceed total steps)
                    currentStep = Math.min(currentStep + 1, totalSteps);

                    // Update the progress bar
                    updateProgressBar(currentStep);

                    // Optionally, submit the form via AJAX or proceed with regular form submission
                    document.querySelector('form').submit(); // If using regular form submission
                });
            }
        });
    </script> --}}
@endsection
