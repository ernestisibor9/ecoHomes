@extends('frontend.agent.agent_dashboard')
@section('agentdashboard')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp

    @php
        $userProgress = App\Models\UserProgress::where('user_id', Auth::user()->id)->first();
    @endphp

    <style>
        .see {
            display: block !important;
        }
    </style>

    <div class="col-lg-12 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">

                    <div class="lower-content">
                        <div class="d-flex pt-3 pb-3" style="justify-content: space-between">
                            <h3>Welcome {{ $profileData->name }}</h3>
                            <a href="{{ route('agent.dashboard') }}" type="button" class="btn btn-primary">Dashboard
                            </a>
                            <a href="{{ route('manage.rooms') }}" type="button" class="btn btn-warning">Back
                            </a>
                        </div>

                        <form class="row g-3" method="post" id="" action="{{ route('update.room') }}"
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
                                <label for="input2" class="form-label">Room Type</label>
                                <select name="room_size" class="form-control see @error('room_size')is-invalid @enderror">
                                    <option value="single_room"
                                        {{ $property->room_size === 'single_room' ? 'selected' : '' }}>
                                        Single Room</option>
                                    <option value="twin_room" {{ $property->room_size === 'twin_room' ? 'selected' : '' }}>
                                        Twin Room</option>
                                    <option value="double_room"
                                        {{ $property->room_size === 'double_room' ? 'selected' : '' }}>
                                        Double Room</option>
                                    <option value="king_size_room"
                                        {{ $property->room_size === 'king_size_room' ? 'selected' : '' }}>
                                        King Size Room</option>
                                    <option value="queen_size_room"
                                        {{ $property->room_size === 'queen_size_room' ? 'selected' : '' }}>
                                        Queen Size Room</option>
                                    <option value="deluxe_room"
                                        {{ $property->room_size === 'deluxe_room' ? 'selected' : '' }}>
                                        Deluxe Room</option>
                                    <option value="junior_suite"
                                        {{ $property->room_size === 'junior_suite' ? 'selected' : '' }}>
                                        Junior Suite</option>
                                        <option value="executive_suite"
                                        {{ $property->room_size === 'executive_suite' ? 'selected' : '' }}>
                                        Executive Suite</option>
                                        <option value="presidential_suite"
                                        {{ $property->room_size === 'presidential_suite' ? 'selected' : '' }}>
                                        Presidential Suite</option>
                                        <option value="micro_room"
                                        {{ $property->room_size === 'micro_room' ? 'selected' : '' }}>
                                        Micro Room</option>
                                        <option value="pool_side_room"
                                        {{ $property->room_size === 'pool_side_room' ? 'selected' : '' }}>
                                        Pool Side Suite</option>
                                </select>
                                @error('room_size')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="input2" class="form-label">Room Number</label>
                                <input type="number" class="form-control @error('room_number')is-invalid @enderror"
                                    name="room_number" id="" value="{{ $property->room_number }}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="input2" class="form-label">Price Per Night</label>
                                <input type="text" class="form-control @error('price_per_night')is-invalid @enderror"
                                    name="price_per_night" id="" value="{{ $property->price_per_night }}">
                                @error('price_per_night')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-4">
                                <label for="input1" class="form-label">No. of Bedrooms </label>
                                <input type="number" name="bedrooms"
                                    class="form-control @error('bedrooms')is-invalid @enderror" id="input1"
                                    value="{{ $property->bedrooms }}">
                                @error('bedrooms')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <label for="input1" class="form-label">No. of Bathrooms</label>
                                <input type="number" name="bathrooms"
                                    class="form-control @error('bathrooms')is-invalid @enderror" id="input1"
                                    value="{{ $property->bathrooms }}">
                                @error('bathrooms')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="input11" class="form-label">Address </label>
                                <textarea class="form-control  @error('address')is-invalid @enderror" id="input11" placeholder="Address ..."
                                    rows="3" name="address">{{ $property->address }}</textarea>
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="input11" class="form-label">Short Description </label>
                                <textarea class="form-control @error('short_desc')is-invalid @enderror" id="input11" rows="2"
                                    name="short_desc">{{ $property->short_description }}</textarea>
                                @error('short_desc')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label for="input11" class="form-label">Long Description </label>
                                <textarea class="form-control @error('long_desc')is-invalid @enderror" id="input11" rows="4"
                                    name="long_desc">{{ $property->long_description }}</textarea>
                                @error('long_desc')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-12 mt-4 mb-5">
                                <div class="d-md-flex d-grid align-items-center gap-3">
                                    <button type="submit" class="btn btn-primary px-4">Update</button>
                                </div>
                            </div>
                        </form>
                        <!--------------Edit Property Image start-------------------------->


                        <div class="col-md-10">
                            <h6 class="mb-0 text-uppercase">Edit Property Thumbnail</h6>
                            <hr>
                            <div class="card">
                                <div class="card-body p-4">
                                    <h5 class="mb-4"></h5>
                                    <form class="row g-3" method="post" id=""
                                        action="{{ route('update.room.thumbnail') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $property->id }}">
                                        <input type="hidden" name="old_img" id=""
                                            value="{{ $property->property_thumbnail }}">

                                        <div class="col-md-6 form-group">
                                            <label for="input2" class="form-label">Property Thumbnail Photo (max
                                                size:1mb)</label>
                                            <input type="file" name="property_thumbnail"
                                                class="form-control @error('property_thumbnail')is-invalid @enderror"
                                                id="input1" onChange="mainThamUrl(this)">
                                            <div class="mt-2">
                                                @error('property_thumbnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <img src="" id="mainThmb">
                                        </div>
                                        <div class="col-md-6 form-group">
                                            <label for="input2" class="form-label"></label>
                                            <img src="{{ asset($property->property_thumbnail) }}" alt=""
                                                width="80px" height="70px">
                                        </div>
                                        <div class="col-md-12">
                                            <div class="d-md-flex d-grid align-items-center gap-3">
                                                <button type="submit" class="btn btn-primary px-4">Update
                                                    Thumbnail</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--------------Property Thumbnail end-------------------------->

                        <!----------------Multiple Images begin------------------------>
                        <div class="col-md-10 mt-4">
                            <h6 class="mb-0 text-uppercase">Edit Multiple Images</h6>
                            <hr>
                            <div class="card">
                                <div class="card-body p-4">
                                    <h5 class="mb-4"></h5>
                                    <form class="row g-3" method="post" id=""
                                        action="{{ route('update.room.multiimg') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $property->id }}">
                                        <input type="hidden" name="old_img" id=""
                                            value="{{ $property->property_thumbnail }}">

                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered"
                                                style="width:100%">
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
                                                                <input type="file"
                                                                    name="multi_img[{{ $img->id }}]" id="multiImg"
                                                                    class="form-control @error('multi_img')is-invalid @enderror"
                                                                    id="input1" multiple="">
                                                                @error('multi_img')
                                                                    <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </td>
                                                            <td>
                                                                <input type="submit" value="Update"
                                                                    class="btn btn-primary">
                                                                <a href="{{ route('property.multiimg.delete', $img->id) }}"
                                                                    title="Delete" class="btn btn-danger"
                                                                    id="delete">Delete</a>
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
        </div>
    </div>
    </div>


    </div>

    </div>
@endsection
