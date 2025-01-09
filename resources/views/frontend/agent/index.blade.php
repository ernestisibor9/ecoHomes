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

    <div class="col-lg-8 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">

                    <div class="lower-content">
                        <h3>Welcome Agent {{ $profileData->name }}</h3>
                        {{-- <h3>
                            @if (!empty($userProgress))
                                <h3><strong>PROPERTY STATUS:</strong> &nbsp;&nbsp;&nbsp; {{ ucfirst($userProgress->current_step) }}</h3>
                            @else
                                <h4><strong>PROPERTY STATUS:</strong> &nbsp;&nbsp;&nbsp; No record yet for tracking </h4>
                            @endif
                        </h3> --}}

                        @if (!empty($userProgress))
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
                        @endif


                        <ul class="post-info clearfix">
                            <li class="author-box">
                                <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt="">
                                </figure>
                                <h5><a href="blog-details.html">{{ $profileData->role }}</a></h5>
                            </li>
                            <li>December 2, 2024</li>
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
@endsection
