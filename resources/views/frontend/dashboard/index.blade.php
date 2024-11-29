@extends('frontend.dashboard.user_dashboard')
@section('userdashboard')
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
                        <h3>Welcome {{ $profileData->name }}</h3>
                        <h3>
                            @if (!empty($userProgress))
                                <h3><strong>STATUS:</strong> &nbsp;&nbsp;&nbsp; {{ ucfirst($userProgress->status) }}</h3>
                            @else
                                <h4><strong>STATUS:</strong> &nbsp;&nbsp;&nbsp; No record yet for tracking </h4>
                            @endif
                        </h3>
                        <ul class="post-info clearfix">
                            <li class="author-box">
                                <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt="">
                                </figure>
                                <h5><a href="blog-details.html">Eva Green</a></h5>
                            </li>
                            <li>April 10, 2020</li>
                        </ul>


                        <form action="signin.html" method="post" class="default-form">
                            <div class="form-group">
                                <label>Agent name</label>
                                <input type="text" name="name" required="">
                            </div>
                            <div class="form-group">
                                <label>Email address</label>
                                <input type="email" name="email" required="">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="name" required="">
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
