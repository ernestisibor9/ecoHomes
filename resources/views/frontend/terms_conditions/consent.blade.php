@extends('frontend.master')

@section('home')
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
        .hidden {
          display: none;
        }
        .form-radio{
            display: flex;
            justify-content: center;
            margin: 20px 50px;
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
                <h1>Consent Form</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Consent Form</li>
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
                    <div class="card-body">
                        <h1 class="card-title text-center">CONSENT FORM</h1>
                        <div class="d-grid gap-2 form-group message-btn mt-4 text-center">
                            <a href="{{asset('frontend/assets/document/consent.pdf')}}" id="downloadBtn"
                            download class="theme-btn btn-one">
                               Download and fill the Consent Form</a>
                        </div>

                        <div id="uploadSection" class="hidden mt-5">
                            <h5 class="text-center">Upload the Consent Form</h5>
                            <form action="{{route('store.consent')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="">Upload Consent Form <span class="text-danger">PDF</span></label>
                                    <input type="file" name="consent_pdf" id="" class="form-control">
                                </div>
                                <div class="form-group mt-4">
                                    <button type="submit" class="theme-btn btn-one">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Register Section End -->

    <!-- JavaScript -->
<script>
    document.getElementById('downloadBtn').addEventListener('click', function() {
        const uploadSection = document.getElementById('uploadSection');
        uploadSection.style.display = 'block'; // Show the hidden section
    });
</script>
@endsection
