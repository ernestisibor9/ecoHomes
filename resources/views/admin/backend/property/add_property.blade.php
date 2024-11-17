@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Add Property
@endsection

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h6 class="mb-0 text-uppercase">Add Property</h6>
            <hr>
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4"></h5>
                    <form class="row g-3" method="post" id="" action="{{ route('store.property') }}"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="col-md-6 form-group">
                            <label for="input1" class="form-label">Property Name</label>
                            <input type="text" name="property_name" class="form-control" id="input1"
                                placeholder="Property Name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Property Status</label>
                            <select id="input7" class="form-select" name="property_status" required>
                                <option selected="" disabled>Select Property Status</option>
                                <option value="buy">For Buy</option>
                                <option value="rent">For Rent</option>
                                <option value="let">For Let</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Price </label>
                            <input type="text" class="form-control" name="price" id="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Amenities </label>
                            <select class="form-select" name="amenities_id[]" id="multiple-select-field"
                                data-placeholder="Select Ameities" multiple required>
                                <option selected="" disabled>Select Property Amenities</option>
                                @foreach ($amenities as $amenity)
                                    <option value="{{ $amenity->id }}">{{ $amenity->amenities_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Property Thumbnail Photo (max size:2mb)</label>
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
                            <label for="input2" class="form-label">Multipe Image (max size:2mb)</label>
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
                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Bedrooms </label>
                            <input type="number" name="bedrooms" class="form-control" id="input1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Bathrooms</label>
                            <input type="number" name="bathrooms" class="form-control" id="input1" required>
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Garage</label>
                            <input type="number" name="garage" class="form-control" id="input1" required>
                        </div>
                        {{-- <div class="col-md-6">
                                <label for="input1" class="form-label">Property Size</label>
                                <input type="text" name="property_size" class="form-control" id="input1">
                            </div> --}}
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Video</label>
                            <input type="text" name="property_video" class="form-control" id="input1">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Type </label>
                            <select id="input7" class="form-select form-group" name="ptype_id" required>
                                <option selected="" disabled>Select Property Type</option>
                                @foreach ($propertyTypes as $ptype)
                                    <option value="{{ $ptype->id }}">{{ $ptype->type_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="input8" class="form-label">City </label>
                            <input type="text" class="form-control" name="city" id="" required>
                        </div>
                        <div class="col-md-6">
                            <label for="input9" class="form-label">Country </label>
                            <select id="input9" class="form-select" name="country">
                                <option selected="">Select Country</option>
                                <option value="usa">USA</option>
                                <option value="uk">UK</option>
                                <option value="nigeria">Nigeria</option>
                                <option value="brazil">Brazil</option>
                                <option value="france">France</option>
                                <option value="germany">Germany</option>
                                <option value="canada">Canada</option>
                                <option value="spain">Spain</option>
                                <option value="italy">Italy</option>
                                <option value="portugal">Portugal</option>
                                <option value="argentina">Argentina</option>
                                <option value="switzerland">Switzerland</option>
                                <option value="china">China</option>
                                <option value="japan">Japan</option>
                                <option value="south-korea">South Korea</option>
                                <option value="south-africa">South Africa</option>
                            </select>
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

                        <div class="row add_item">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="facility_name" class="form-label">Facilities </label>
                                    <select name="facility_name[]" id="facility_name" class="form-control">
                                        <option value="">Select Facility</option>
                                        <option value="Hospital">Hospital</option>
                                        <option value="SuperMarket">Super Market</option>
                                        <option value="School">School</option>
                                        <option value="Entertainment">Entertainment</option>
                                        <option value="Pharmacy">Pharmacy</option>
                                        <option value="Airport">Airport</option>
                                        <option value="Railways">Railways</option>
                                        <option value="Bus Stop">Bus Stop</option>
                                        <option value="Beach">Beach</option>
                                        <option value="Mall">Mall</option>
                                        <option value="Bank">Bank</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="col-md-4">
                                  <div class="mb-3">
                                        <label for="distance" class="form-label"> Distance </label>
                                        <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                                  </div>
                            </div> --}}
                            <div class="form-group col-md-4" style="padding-top: 30px;">
                                <a class="btn btn-success addeventmore"><i class="fa fa-plus-circle"></i> Add
                                    More..</a>
                            </div>
                        </div> <!---end row-->

                        <!----------------Facility end---------------------------->


                        <!----------------Facility hidden start---------------------------------------->
                        <!--========== Start of add multiple class with ajax ==============-->
                        <div style="visibility: hidden">
                            <div class="whole_extra_item_add" id="whole_extra_item_add">
                                <div class="whole_extra_item_delete" id="whole_extra_item_delete">
                                    <div class="container mt-2">
                                        <div class="row">

                                            <div class="form-group col-md-4">
                                                <label for="facility_name">Facilities</label>
                                                <select name="facility_name[]" id="facility_name"
                                                    class="form-control">
                                                    <option value="">Select Facility</option>
                                                    <option value="Hospital">Hospital</option>
                                                    <option value="SuperMarket">Super Market</option>
                                                    <option value="School">School</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Pharmacy">Pharmacy</option>
                                                    <option value="Airport">Airport</option>
                                                    <option value="Railways">Railways</option>
                                                    <option value="Bus Stop">Bus Stop</option>
                                                    <option value="Beach">Beach</option>
                                                    <option value="Mall">Mall</option>
                                                    <option value="Bank">Bank</option>
                                                </select>
                                            </div>
                                            {{-- <div class="form-group col-md-4">
                   <label for="distance">Distance</label>
                   <input type="text" name="distance[]" id="distance" class="form-control" placeholder="Distance (Km)">
                </div> --}}
                                            <div class="form-group col-md-4" style="padding-top: 20px">
                                                <span class="btn btn-success btn-sm addeventmore"><i
                                                        class="fa fa-plus-circle">Add</i></span>
                                                <span class="btn btn-danger btn-sm removeeventmore"><i
                                                        class="fa fa-minus-circle">Remove</i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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

@endsection
