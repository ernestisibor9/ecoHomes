@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Edit Property
@endsection

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h6 class="mb-0 text-uppercase">Edit Property</h6>
            <hr>
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4"></h5>
                    <form class="row g-3" method="post" id="" action="{{ route('update.property') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $property->id }}">

                        <div class="col-md-6 form-group">
                            <label for="input1" class="form-label">Property Name</label>
                            <input type="text" name="property_name" class="form-control" id="input1"
                                placeholder="Property Name" value="{{ $property->property_name }}">
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Property Status</label>
                            <select id="input7" class="form-select" name="property_status">
                                <option selected="" disabled>Select Property Status</option>
                                <option value="buy" {{ $property->property_status === 'buy' ? 'selected' : '' }}>For
                                    Buy</option>
                                <option value="rent" {{ $property->property_status === 'rent' ? 'selected' : '' }}>For
                                    Rent</option>
                                <option value="lease" {{ $property->property_status === 'lease' ? 'selected' : '' }}>For
                                    Let</option>
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Price </label>
                            <input type="text" class="form-control" name="price" id=""
                                value="{{ $property->price }}">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Amenities </label>
                            <select class="form-select" name="amenities_id[]" id="multiple-select-field"
                                data-placeholder="Select Ameities" multiple required>
                                @foreach ($amenities as $amenity)
                                    <option value="{{ $amenity->id }}"
                                        {{ in_array($amenity->id, $property_amen) ? 'selected' : '' }}>
                                        {{ $amenity->amenities_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Bedrooms </label>
                            <input type="number" name="bedrooms" class="form-control" id="input1"
                                value="{{ $property->bedrooms }}">
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Bathrooms</label>
                            <input type="number" name="bathrooms" class="form-control" id="input1"
                                value="{{ $property->bathrooms }}">
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Garage</label>
                            <input type="number" name="garage" class="form-control" id="input1"
                                value="{{ $property->garage }}">
                        </div>
                        {{-- <div class="col-md-6">
                                <label for="input1" class="form-label">Property Size</label>
                                <input type="text" name="property_size" class="form-control" id="input1">
                            </div> --}}
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Video</label>
                            <input type="text" name="property_video" class="form-control" id="input1"
                                value="{{ $property->property_video }}">
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Type </label>
                            <select id="input7" class="form-select form-group" name="ptype_id" required>
                                {{-- <option selected="" disabled>Select Property Type</option> --}}
                                @foreach ($propertyTypes as $ptype)
                                    <option value="{{ $ptype->id }}"
                                        {{ $ptype->id === $property->ptype_id ? 'selected' : '' }}>
                                        {{ $ptype->type_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="col-md-6">
                            <label for="input8" class="form-label">City </label>
                            <input type="text" class="form-control" name="city" id=""
                                value="{{ $property->city }}">
                        </div>
                        <div class="col-md-6">
                            <label for="input9" class="form-label">Country </label>
                            <select id="input9" class="form-select" name="country">
                                <option value="usa" {{ $property->country === 'usa' ? 'selected' : '' }}>USA
                                </option>
                                <option value="uk" {{ $property->country === 'uk' ? 'selected' : '' }}>UK</option>
                                <option value="nigeria" {{ $property->country === 'nigeria' ? 'selected' : '' }}>
                                    Nigeria</option>
                                <option value="brazil" {{ $property->country === 'brazil' ? 'selected' : '' }}>Brazil
                                </option>
                                <option value="france" {{ $property->country === 'france' ? 'selected' : '' }}>France
                                </option>
                                <option value="germany" {{ $property->country === 'germany' ? 'selected' : '' }}>
                                    Germany</option>
                                <option value="canada" {{ $property->country === 'canada' ? 'selected' : '' }}>Canada
                                </option>
                                <option value="spain" {{ $property->country === 'spain' ? 'selected' : '' }}>Spain
                                </option>
                                <option value="italy" {{ $property->country === 'italy' ? 'selected' : '' }}>Italy
                                </option>
                                <option value="portugal" {{ $property->country === 'portugal' ? 'selected' : '' }}>
                                    Portugal</option>
                                <option value="argentina" {{ $property->country === 'argentina' ? 'selected' : '' }}>
                                    Argentina</option>
                                <option value="switzerland"
                                    {{ $property->country === 'switzerland' ? 'selected' : '' }}>Switzerland</option>
                                <option value="china" {{ $property->country === 'china' ? 'selected' : '' }}>China
                                </option>
                                <option value="japan" {{ $property->country === 'japan' ? 'selected' : '' }}>Japan
                                </option>
                                <option value="south-korea"
                                    {{ $property->country === 'south-korea' ? 'selected' : '' }}>South Korea</option>
                                <option value="south-africa"
                                    {{ $property->country === 'south-korea' ? 'selected' : '' }}>South Africa</option>
                            </select>
                        </div> --}}
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Address </label>
                            <textarea class="form-control" required id="input11" placeholder="Address ..." rows="3" name="address">{{ $property->address }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Short Description </label>
                            <textarea class="form-control" required id="input11" rows="2" name="short_desc">{{ $property->short_description }}</textarea>
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Long Description </label>
                            <textarea class="form-control" required id="input11" rows="4" name="long_desc">{{ $property->long_description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" {{ $property->featured === '1' ? 'checked' : '' }}
                                    type="checkbox" id="input12" value="1" name="featured">
                                <label class="form-check-label" for="input12" name="short_desc">Featured</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input" {{ $property->hot === '1' ? 'checked' : '' }}
                                    type="checkbox" id="input12" value="1" name="hot">
                                <label class="form-check-label" for="input12" name="short_desc">Hot</label>
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--------------Edit Property Image start-------------------------->


        <div class="col-md-10">
            <h6 class="mb-0 text-uppercase">Edit Property Thumbnail</h6>
            <hr>
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4"></h5>
                    <form class="row g-3" method="post" id=""
                        action="{{ route('update.property.thumbnail') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $property->id }}">
                        <input type="hidden" name="old_img" id=""
                            value="{{ $property->property_thumbnail }}">

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
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label"></label>
                            <img src="{{ asset($property->property_thumbnail) }}" alt="" width="80px"
                                height="70px">
                        </div>
                        <div class="col-md-12">
                            <div class="d-md-flex d-grid align-items-center gap-3">
                                <button type="submit" class="btn btn-primary px-4">Update Thumbnail</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--------------Property Thumbnail end-------------------------->

        <!----------------Multiple Images begin------------------------>
        <div class="col-md-10">
            <h6 class="mb-0 text-uppercase">Edit Multiple Images</h6>
            <hr>
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="mb-4"></h5>
                    <form class="row g-3" method="post" id=""
                        action="{{ route('update.property.multiimg') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $property->id }}">
                        <input type="hidden" name="old_img" id=""
                            value="{{ $property->property_thumbnail }}">

                        <div class="table-responsive">
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Image</th>
                                        <th>Change Image</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($multiImages as $key => $img)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td><img src="{{ asset($img->photo_name) }}" alt="" width="60px" height="50px"></td>
                                            <td>
                                                <input type="file" name="multi_img[{{$img->id}}]" id="multiImg"
                                                    class="form-control" id="input1" multiple="">
                                            </td>
                                            <td>
                                                <input type="submit" value="Update" class="btn btn-primary">
                                                <a href="{{route('property.multiimg.delete', $img->id)}}" title="Delete"
                                                    class="btn btn-danger" id="delete">Delete</a>
                                            </td>
                                        </tr>
                        </div>
                        @endforeach
                        </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <!----------------Multiple Images end------------------------>
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
