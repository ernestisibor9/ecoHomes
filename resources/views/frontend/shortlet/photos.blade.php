@extends('frontend.master')

@section('home')
    @include('components.progress-tracker', ['step' => 4])

    <div class="container mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="text-center text-title">Step 4: Upload Photos</h3>
                        <form action="{{ route('shortlet.photos.store', ['hotel' => $hotel->id, 'room' => $room->id]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-5 mt-4">
                                <div class="col-md-8">
                                    <label for="">Upload Photo <span class="text-danger">(max: 2MB)</span></label>
                                    <input type="file" class="form-control-file" name="photo_name"
                                        onChange="mainThamUrl(this)">

                                </div>

                                <div class="col-md-4">
                                    <img src="" id="mainThmb">
                                </div>
                            </div>

                            <div class="col-md-12 mb-5">
                                <label for="">Upload Multiple Photos <span class="text-danger">(max: 2MB)</span></label>
                                <input type="file" class="form-control-file" multiple name="multi_photo_name[]"
                                    id="multiImg">
                                <div>
                                    <div class="row" id="preview_img"></div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="{{ route('hotel.rooms', ['hotel' => $hotel->id]) }}"
                                    class="theme-btn btn-one bg-danger text-decoration-none mr-5" id="backButton">Back</a>
                                    <button class="theme-btn btn-one" type="submit" id="nextButton">Next</button>
                                </div>
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
                    $('#mainThmb').attr('src', e.target.result).width(150).height(150);
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
                                            e.target.result).width(150)
                                        .height(130); //create image element
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
@endsection
