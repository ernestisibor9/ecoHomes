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
                                <h3><strong>STATUS:</strong> &nbsp;&nbsp;&nbsp; {{ ucfirst($userProgress->current_step) }}</h3>
                            @else
                                <h4><strong>STATUS:</strong> &nbsp;&nbsp;&nbsp; No record yet for tracking </h4>
                            @endif
                        </h3>
                        <ul class="post-info clearfix">
                            <li class="author-box">
                                <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt="">
                                </figure>
                                <h5><a href="blog-details.html">{{ $profileData->role }}</a></h5>
                            </li>
                            <li>December 2, 2024</li>
                        </ul>

                        <h4>Upload Documents (PDF)</h4>
                        <form action="#" method="post" class="default-form">
                            <div class="form-group">
                                <label>Title of Property</label>
                                <input type="text" name="name"
                               >
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label">Upload documents PDF</label>
                                <input class="form-control" type="file" id="formFile">
                            </div>

                            <div class="form-group message-btn">
                                <button type="submit" class="theme-btn btn-one">Upload
                                </button>
                            </div>
                        </form>



                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
