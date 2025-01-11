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

    <div class="col-lg-12 col-md-12 col-sm-12 content-side">
        <div class="blog-details-content">
            <div class="news-block-one">
                <div class="inner-box">

                    <div class="lower-content">
                        <div class="d-flex pt-3 pb-3" style="justify-content: space-between">
                            <h3>Welcome {{ $profileData->name }}</h3>
                            <a href="{{ route('agent.dashboard') }}" type="button" class="btn btn-primary">Dashboard
                            </a>
                        </div>



                        {{-- <ul class="post-info clearfix">
                            <li class="author-box">
                                <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt="">
                                </figure>
                                <h5><a href="blog-details.html">{{ $profileData->role }}</a></h5>
                            </li>
                            <li>December 2, 2024</li>
                        </ul> --}}

                        <table class="table table-responsive table-striped">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Room Type</th>
                                    <th>Room No.</th>
                                    <th>Price Per Night</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $key => $property)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <th><img src="{{ asset($property->property_thumbnail) }}" alt=""
                                                width="80px" height="70px"></th>
                                        <td>{{ $property->property_name }}</td>
                                        <td>{{ $property->room_size }}</td>
                                        <td>{{ $property->room_number }}</td>
                                        <td>{{ number_format($property->price_per_night, 2) }}</td>
                                        <td>
                                            @if ($property->is_available == '1')
                                                <span class="badge rounded-pill bg-success text-white">Available</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger text-white">Booked</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('room.details', $property->id) }}" title="Details"
                                                class="btn btn-warning">View</a>
                                            <a href="{{ route('room.edit', $property->id) }}" title="Edit"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('room.delete', $property->id) }}" title="Delete"
                                                class="btn btn-danger" id="delete">Delete</a>
                                            <a href="{{ route('change.room.status', $property->id) }}"
                                                class="btn btn-{{ $property->is_available == '1' ? 'secondary' : 'success' }}">{{ $property->is_available  == '1' ? 'Book' : 'Available' }}
                                            </a> &nbsp;
                                        </td>
                                    </tr>
                    </div>
                    @endforeach
                    </tbody>
                    </table>
                    <hr>
                    {{-- <form action="signin.html" method="post" class="default-form">
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
                        </form> --}}


                    {!! $rooms->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>


    </div>


    </div>
@endsection
