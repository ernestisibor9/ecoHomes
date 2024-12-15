@php
    $id = Auth::user()->id;
    $profileData = App\Models\User::find($id);

    $sellerDoc = App\Models\UserProgress::where('current_step', 'step2')->where('status', 'approved')->first();
@endphp
<div class="col-lg-4 col-md-12 col-sm-12 sidebar-side">
    <div class="blog-sidebar">
        <div class="sidebar-widget post-widget">
            <div class="widget-title">
                <h4>User Profile </h4>
            </div>
            <div class="post-inner">
                <div class="post">
                    <figure class="post-thumb"><a href="blog-details.html">
                            <img src="{{ asset('frontend/assets/images/avaterme.jpeg') }}" alt=""></a></figure>
                    <h5><a href="blog-details.html">{{ $profileData->name }} </a></h5>
                    <p>{{ $profileData->email }} </p>
                </div>
            </div>
        </div>

        <div class="sidebar-widget category-widget">
            <div class="widget-title">
                <h4>Category</h4>
            </div>
            <div class="widget-content">
                <ul class="category-list ">

                    <li class="current"> <a href="{{ url('/dashboard') }}"><i class="fab fa fa-envelope "></i> Dashboard
                        </a></li>


                    {{-- <li><a href="blog-details.html"><i class="fa fa-cog" aria-hidden="true"></i>
                            Settings</a></li>
                    <li><a href="blog-details.html"><i class="fa fa-credit-card"
                                aria-hidden="true"></i> Buy credits<span
                                class="badge badge-info">( 10 credits)</span></a></li>
                    <li><a href="blog-details.html"><i class="fa fa-list-alt"
                                aria-hidden="true"></i></i> Properties </a></li> --}}
                    <li><a href="{{ route('form.step1') }}"><i class="fa fa-indent" aria-hidden="true"></i> Add
                            Property </a></li>
                    <li><a href="{{ route('list.all.property') }}"><i class="fa fa-indent" aria-hidden="true"></i> Book
                            Property </a></li>
                    <li><a href="blog-details.html"><i class="fa fa-key" aria-hidden="true"></i>
                            Change Password </a></li>
                    <li><a href="{{ route('user.logout') }}"><i class="fa fa-chevron-circle-up" aria-hidden="true"></i>
                            Logout </a></li>
                    @if ($sellerDoc)
                        <li><a href="{{ route('upload.property') }}"><i class="fa fa-list-alt"
                                    aria-hidden="true"></i></i> Upload Property Docs </a></li>
                    @endif
                </ul>
            </div>
        </div>

    </div>
</div>
