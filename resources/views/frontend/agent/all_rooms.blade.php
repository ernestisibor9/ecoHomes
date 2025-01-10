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
                        <h3>Welcome Agent {{ $profileData->name }}</h3>


                        <ul class="post-info clearfix">
                            <li class="author-box">
                                <figure class="author-thumb"><img src="assets/images/news/author-1.jpg" alt="">
                                </figure>
                                <h5><a href="blog-details.html">{{ $profileData->role }}</a></h5>
                            </li>
                            <li>December 2, 2024</li>
                        </ul>

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
                                        <td>{{ $property->price_per_night }}</td>
                                        <td>
                                            @if ($property->status === true)
                                                <span class="badge rounded-pill bg-success text-white">Available</span>
                                            @else
                                                <span class="badge rounded-pill bg-danger text-white">Booked</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('change.property.status', $property->id) }}"
                                                class="btn btn-{{ $property->status === '0' ? 'success' : 'danger' }}">{{ $property->status === '0' ? 'Active' : 'Inactive' }}
                                            </a> &nbsp; --}}
                                            <a href="{{ route('property.details', $property->id) }}" title="Details"
                                                class="btn btn-warning">View</a>
                                            <a href="{{ route('property.edit', $property->id) }}" title="Edit"
                                                class="btn btn-primary">Edit</a>
                                            <a href="{{ route('property.delete', $property->id) }}" title="Delete"
                                                class="btn btn-danger" id="delete">Delete</a>
                                            <a href="{{ route('availability.create', $property->id) }}"
                                                title="Availability" class="btn btn-success">Room Status</a>
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
