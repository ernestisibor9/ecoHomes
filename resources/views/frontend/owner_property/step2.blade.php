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

        .progress {
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar-custom {
            background: linear-gradient(to right, #4caf50, #81c784);
            color: white;
            font-weight: bold;
        }

        #statusMessage {
            display: none; /* Initially hidden */
        }
    </style>

    <!-- Page Title -->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});"></div>
            <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});"></div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Sell Property</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Sell My Property</li>
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
                    <div class="progress">
                        <div class="progress-bar progress-bar-custom" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75%</div>
                    </div>

                    <div class="card-body">
                        <div class="text-center" style="line-height: 30px;">
                            <h3>Qualification stage</h3>
                            <p class="text-dark">Current Step: 3/4</p>
                            <p class="text-dark">Status: {{ Str::ucfirst($progress->status) }}</p>

                            <!-- Status Message Div -->
                            <div id="statusMessage">
                                @if ($progress->status == 'approved')
                                    <a href="{{ route('form.step3') }}">Proceed to Step 4</a>
                                    <p>You will be expected to fill a contract form</p>
                                @elseif($progress->status == 'rejected')
                                    <p class="text-danger">Your submission has been rejected. Please contact support.</p>
                                @else
                                    <p class="text-dark">Your submission is pending approval. We will contact you soon</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Section End -->

    <script>
        window.onload = function() {
            // Get the status from the Laravel variable
            var status = '{{ $progress->status }}';

            // Get the status message div
            var statusMessageDiv = document.getElementById('statusMessage');

            // Check if the status is set to 'approved' or 'rejected'
            if (status === 'approved' || status === 'rejected') {
                // Show the status message div
                statusMessageDiv.style.display = 'block';
            } else {
                // Keep the status message div hidden if the status is 'pending'
                statusMessageDiv.style.display = 'none';
            }
        };
    </script>

@endsection
