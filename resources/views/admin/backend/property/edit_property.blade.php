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
                            <input type="text" name="property_name"
                                class="form-control
                            @error('property_name')is-invalid @enderror"
                                id="input1" placeholder="Property Name" value="{{ $property->property_name }}">
                            @error('property_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Property Status</label>
                            <select id="input7" class="form-select @error('property_status')is-invalid @enderror" name="property_status">
                                <option value="buy" {{ $property->property_status === 'buy' ? 'selected' : '' }}>
                                    Buy</option>
                                <option value="rent" {{ $property->property_status === 'rent' ? 'selected' : '' }}>
                                    Rent</option>
                                <option value="lease" {{ $property->property_status === 'lease' ? 'selected' : '' }}>
                                    Let</option>
                                <option value="lease" {{ $property->property_status === 'book' ? 'selected' : '' }}>
                                    Book</option>
                            </select>
                            @error('property_status')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Price </label>
                            <input type="text" class="form-control" name="price" id=""
                                value="{{ $property->price }}">
                        </div>

                        <div class="col-md-6 form-group">
                            <label for="input2" class="form-label">Price Per Night</label>
                            <input type="text" class="form-control @error('price_per_night')is-invalid @enderror" name="price_per_night" id=""
                                value="{{ $property->price_per_night }}">
                                @error('price_per_night')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Bedrooms </label>
                            <input type="number" name="bedrooms" class="form-control @error('bedrooms')is-invalid @enderror" id="input1"
                                value="{{ $property->bedrooms }}">
                                @error('bedrooms')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Bathrooms</label>
                            <input type="number" name="bathrooms" class="form-control @error('bathrooms')is-invalid @enderror" id="input1"
                                value="{{ $property->bathrooms }}">
                                @error('bathrooms')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="input1" class="form-label">No. of Garage</label>
                            <input type="number" name="garage" class="form-control @error('garage')is-invalid @enderror" id="input1"
                                value="{{ $property->garage }}">
                                @error('garage')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Video</label>
                            <input type="text" name="property_video" class="form-control @error('property_video')is-invalid @enderror" id="input1"
                                value="{{ $property->property_video }}">
                                @error('property_video')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="input1" class="form-label">Property Type </label>
                            <select id="input7" class="form-select  @error('ptype_id')is-invalid @enderror form-group" name="ptype_id">
                                {{-- <option selected="" disabled>Select Property Type</option> --}}
                                @foreach ($propertyTypes as $ptype)
                                    <option value="{{ $ptype->id }}"
                                        {{ $ptype->id === $property->ptype_id ? 'selected' : '' }}>
                                        {{ $ptype->type_name }}
                                    </option>
                                @endforeach
                                @error('ptype_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Address </label>
                            <textarea class="form-control  @error('address')is-invalid @enderror" id="input11" placeholder="Address ..." rows="3" name="address">{{ $property->address }}</textarea>
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Short Description </label>
                            <textarea class="form-control @error('short_desc')is-invalid @enderror" id="input11" rows="2" name="short_desc">{{ $property->short_description }}</textarea>
                            @error('short_desc')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="col-md-12">
                            <label for="input11" class="form-label">Long Description </label>
                            <textarea class="form-control @error('long_desc')is-invalid @enderror" id="input11" rows="4" name="long_desc">{{ $property->long_description }}</textarea>
                            @error('long_desc')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input @error('featured')is-invalid @enderror" {{ $property->featured === '1' ? 'checked' : '' }}
                                    type="checkbox" id="input12" value="1" name="featured">
                                <label class="form-check-label" for="input12" name="">Featured</label>
                                @error('featured')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check">
                                <input class="form-check-input @error('hot')is-invalid @enderror" {{ $property->hot === '1' ? 'checked' : '' }}
                                    type="checkbox" id="input12" value="1" name="hot">
                                <label class="form-check-label" for="input12" name="short_desc">Hot</label>
                                @error('hot')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
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
                            <label for="input2" class="form-label">Property Thumbnail Photo (max size:1mb)</label>
                            <input type="file" name="property_thumbnail"
                                class="form-control @error('property_thumbnail')is-invalid @enderror" id="input1"
                                onChange="mainThamUrl(this)">
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
                                            <td><img src="{{ asset($img->photo_name) }}" alt=""
                                                    width="60px" height="50px"></td>
                                            <td>
                                                <input type="file" name="multi_img[{{ $img->id }}]"
                                                    id="multiImg"
                                                    class="form-control @error('multi_img')is-invalid @enderror"
                                                    id="input1" multiple="">
                                                @error('multi_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </td>
                                            <td>
                                                <input type="submit" value="Update" class="btn btn-primary">
                                                <a href="{{ route('property.multiimg.delete', $img->id) }}"
                                                    title="Delete" class="btn btn-danger" id="delete">Delete</a>
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
                    : true,
                },
                property_status: {
                    : true,
                },
                price: {
                    : true,
                },
                property_category: {
                    : true,
                },
                ptype_id: {
                    : true
                }

            },
            messages: {
                property_name: {
                    : 'Please Enter Property Name',
                },
                property_status: {
                    : 'Please Select Property Status',
                },
                price: {
                    : 'Please Select Price',
                },
                property_category: {
                    : 'Please Select Property Category',
                },
                ptype_id: {
                    : 'Please Select a Property Type',
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
