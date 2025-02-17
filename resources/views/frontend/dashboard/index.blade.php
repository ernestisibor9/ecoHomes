@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <style>
        /* Style the dropdown button */
        .dropbtn {
            background-color: #0F724B;
            color: white;
            padding: 12px 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        /* Dropdown container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: white;
            min-width: 160px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 5px;
            z-index: 1;
        }

        /* Dropdown links */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Show the dropdown on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change color on hover */
        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .show {
            display: block;
        }
    </style>

    @php
        $id = Auth::user()->id;
        $profileData = App\Models\User::find($id);
    @endphp

    @php
        $userProgress = App\Models\UserProgress::where('user_id', Auth::user()->id)->first();
    @endphp

    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">

                    <div class="lower-content">
                        <div class="d-flex justify-content-between">
                            <h3>Welcome {{ $profileData->name }}</h3>
                            <div class="dropdown">
                                <button class="dropbtn" onclick="toggleDropdown()">List Your Property</button>
                                <div class="dropdown-content" id="myDropdown">
                                    <a href="{{ route('apartment.flat') }}" class="text-decoration-none">Flat</a>
                                    <a href="{{ route('apartment.house') }}" class="text-decoration-none">House</a>
                                    <a href="{{ route('commercial.property') }}" class="text-decoration-none">Commercial
                                        Property</a>

                                    <a href="{{ route('land.property') }}" class="text-decoration-none">Land &
                                        Plots </a>

                                </div>
                            </div>
                        </div>
                        {{-- <h3>
                            @if (!empty($userProgress))
                                <h3><strong>PROPERTY STATUS:</strong> &nbsp;&nbsp;&nbsp; {{ ucfirst($userProgress->current_step) }}</h3>
                            @else
                                <h4><strong>PROPERTY STATUS:</strong> &nbsp;&nbsp;&nbsp; No record yet for tracking </h4>
                            @endif
                        </h3> --}}

                        {{-- @if (!empty($userProgress))
                            @if ($userProgress->current_step == 'step1')
                                <h4><strong>PROPERTY STATUS:</strong> &nbsp;&nbsp; <span class="text-success">Pending Stage</span></h4>
                            @elseif ($userProgress->current_step == 'step2')
                                <h4><strong>PROPERTY STATUS:</strong> &nbsp;&nbsp; <span class="text-success">Verification Stage</span></h4>
                            @elseif ($userProgress->current_step == 'step3')
                                <h4><strong>PROPERTY STATUS:</strong> &nbsp;&nbsp; <span class="text-success">Contract Stage</span></h4>
                            @else
                                <p><strong>PROPERTY STATUS:</strong> <span class="text-success">Closure of Business</span></p>
                            @endif
                        @else
                            <p></p>
                        @endif --}}


                        <ul class="post-info clearfix">
                            <li class="author-box">
                                <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt="">
                                </figure>
                                <h5><a href="blog-details.html">{{ $profileData->role }}</a></h5>
                            </li>
                            <li>

                            </li>
                        </ul>



                        <form action="signin.html" method="post" class="default-form">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $profileData->name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" value="{{ $profileData->email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" name="name" required="" value="{{ $profileData->role }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label">Default file input
                                    example</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>


                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Save Changes
                                </button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>


        </div>


    </div>

    <script>
        function toggleDropdown() {
            document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside
        window.onclick = function(event) {
            if (!event.target.matches('.dropbtn')) {
                let dropdowns = document.getElementsByClassName("dropdown-content");
                for (let i = 0; i < dropdowns.length; i++) {
                    let openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        };
    </script>
@endsection
