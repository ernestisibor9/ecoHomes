@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Add Property
@endsection

<style>
    .hidden {
        display: none;
    }
</style>

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h6 class="mb-0 text-uppercase">Add Property</h6>
            <hr>
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4"></h5>
                    <form class="row g-3" method="post" id="myForm" action="{{ route('store.property') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6 form-group">
                            <label for="input1" class="form-label">Property Name</label>
                            <input type="text" name="property_name" class="form-control
                            @error('property_name')is-invalid @enderror" id="input1"
                                placeholder="Property Name" required>
                                @error('property_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Property Status</label>
                            <select id="input7" class="form-select
                            @error('property_status')is-invalid @enderror" name="property_status" required>
                                <option selected="" disabled>Select Property Status</option>
                                <option value="buy">Buy</option>
                                <option value="rent">Rent</option>
                                <option value="lease">Lease</option>
                                <option value="book">Book</option>
                            </select>
                            @error('property_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Amenities </label>
                            <select class="form-select" name="amenities_id[]" id="multiple-select-field"
                                data-placeholder="Select Ameities" multiple required>
                                <option selected="" disabled>Select Property Amenities</option>
                                @foreach ($amenities as $amenity)
                                    <option value="{{ $amenity->amenities_name }}">{{ $amenity->amenities_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Property Thumbnail Photo (max size:1mb)</label>
                            <input type="file" name="property_thumbnail"
                                class="form-control @error('property_thumbnail')is-invalid @enderror" id="input1"
                                onChange="mainThamUrl(this)" required>
                            <div class="mt-2">
                                @error('property_thumbnail')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <img src="" id="mainThmb">
                        </div>
                        <div class="col-md-6">
                            <label for="input2" class="form-label">Multipe Image (max size:1mb)</label>
                            <input type="file" name="multi_img[]" id="multiImg"
                                class="form-control @error('multi_img')is-invalid @enderror" id="input1"
                                multiple="">
                            <div class="mt-2">
                                @error('multi_img')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row" id="preview_img"></div>
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">No. of Bedrooms </label>
                            <input type="number" name="bedrooms" class="form-control" id="input1">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">No. of Bathrooms</label>
                            <input type="number" name="bathrooms" class="form-control" id="input1">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">No. of Garage</label>
                            <input type="number" name="garage" class="form-control" id="input1">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Seller's Name</label>
                            <select id="input7" class="form-select form-group
                            " name="seller_id" required>
                                <option selected="" disabled>Select Seller</option>
                                @foreach ($sellers as $seller)
                                    <option value="{{ $seller->id }}">{{ $seller->firstname }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Verification Status</label>
                            <select id="input7" class="form-select form-group" name="verification_status">
                                <option selected="" disabled>Verification Status</option>
                                <option value="1">Verified</option>
                                <option value="0">Unverified</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Video</label>
                            <input type="text" name="property_video" class="form-control" id="input1">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Type </label>
                            <select id="property_type" class="form-select form-group" name="ptype_id">
                                <option selected="" disabled>Select Property Type</option>
                                @foreach ($propertyTypes as $ptype)
                                    <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                            <div class="row mt-3 hidden" id="extra-fields">
                                <div class="col-md-6 mb-2">
                                    <label for="input1" class="form-label">Price Per Night <span>(Hotels & Shortlet only)</span></label>
                                    <input type="number" name="price_per_night" class="form-control
                                    " id="input1" >
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label for="input1" class="form-label">Guest Capacity</label>
                                    <input type="number" name="guest_capacity" class="form-control" id="input1" >
                                </div>
                            </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label for="">Country</label>
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
                            <div class="col-md-6 field" id="priceFields">
                                <label for="input1" class="form-label">Price</label>
                                <input type="text" name="price" class="form-control
                                @error('price')is-invalid @enderror" id="input1">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6" id="select-state-group" style="display: none;">
                                <label for="">State/County</label>
                                <select name="state_id"
                                    class="form-control see
                                @error('state_id')is-invalid @enderror "
                                    required style="display: block">
                                    {{-- <option value="">Select State</option> --}}
                                </select>
                                @error('state_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-12 col-md-6" id="select-city-group" style="display: none;">
                                <label for="">City/Town</label>
                                <select name="city_id" class="form-control see" style="display: block">
                                    {{-- <option value="">Select City</option> --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Address </label>
                            <textarea class="form-control" required id="input11" placeholder="Address ..." rows="3" name="address"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Short Description </label>
                            <textarea class="form-control" required id="input11" rows="2" name="short_desc"></textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Long Description </label>
                            <textarea class="form-control" required id="input11" rows="4" name="long_desc"></textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="input12" value="1"
                                    name="featured">
                                <label class="form-check-label" for="input12" name="short_desc">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="input12" value="1"
                                    name="hot">
                                <label class="form-check-label" for="input12" name="short_desc">Hot</label>
                            </div>
                        </div>


                        <!----------------Facility start--------------------------->



                        <!----------------Facility hidden end--------------------------------------->


                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
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
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


<!----For Section-------->
<script type="text/javascript">
    $(document).ready(function() {
        var counter = 0;
        $(document).on("click", ".addeventmore", function() {
            var whole_extra_item_add = $("#whole_extra_item_add").html();
            $(this).closest(".add_item").append(whole_extra_item_add);
            counter++;
        });
        $(document).on("click", ".removeeventmore", function(event) {
            $(this).closest("#whole_extra_item_delete").remove();
            counter -= 1
        });
    });
</script>
<!--========== End of add multiple class with ajax ==============-->


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

<!-- Validate js -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                property_name: {
                    required: true,
                },
                property_status: {
                    required: true,
                },
                price: {
                    required: true,
                },
                property_category: {
                    required: true,
                },
                ptype_id: {
                    required: true
                }

            },
            messages: {
                property_name: {
                    required: 'Please Enter Property Name',
                },
                property_status: {
                    required: 'Please Select Property Status',
                },
                price: {
                    required: 'Please Select Price',
                },
                property_category: {
                    required: 'Please Select Property Category',
                },
                ptype_id: {
                    required: 'Please Select a Property Type',
                }

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>
<!-- End Validate js -->


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
// document.addEventListener("DOMContentLoaded", function () {
//     const propertyTypeSelect = document.getElementById('property_type');
//     const priceFields = document.getElementById('priceFields');
//     const hotelFields = document.getElementById('hotelFields');

//     // Function to handle form field visibility based on property type
//     function toggleFields() {
//         const selectedType = propertyTypeSelect.value; // Get selected value

//         if (selectedType === '6' || selectedType==='3') { // Check for hotel ID (e.g., 1 for hotel)
//             // Show hotel-specific fields and hide price-related fields
//             hotelFields.style.display = 'block';
//             if (priceFields) {
//                 priceFields.style.display = 'none';
//             }
//         } else {
//             // Show price-related fields and hide hotel-specific fields
//             hotelFields.style.display = 'none';
//             if (priceFields) {
//                 priceFields.style.display = 'block';
//             }
//         }
//     }

//     // Listen for changes to the property type select field
//     propertyTypeSelect.addEventListener('change', toggleFields);

//     // Initialize fields based on the initial selection
//     toggleFields();
// });

</script>

<script>
    $(document).ready(function () {
        const propertyTypesToShow = [3,6];

        $('#property_type').on('change', function () {
            const selectedValue = $(this).val();
            if (propertyTypesToShow.includes(parseInt(selectedValue))) {
                $('#extra-fields').removeClass('hidden');
            } else {
                $('#extra-fields').addClass('hidden');
            }
        });
    });
</script>

@endsection
