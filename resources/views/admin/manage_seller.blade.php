@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    Cedar - Admin Dashboard
@endsection

{{-- @php
    $registeredStudents = App\Models\User::where('role', 'user')->get();
    $enrollStudents = App\Models\Payment::latest()->get();
    $totalCourses = App\Models\Course::latest()->get();
    $blogPost = App\Models\BlogPost::latest()->get();
    $payment = App\Models\Payment::latest()->get();
@endphp --}}


<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="">
                                <p class="mb-0 text-secondary">Registered Users</p>
                                <h4 class="my-1 text-info">5</h4>
                                <p class="mb-0 font-13">Total registered users</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i
                                class='bx bxs-user-plus'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="">
                                <p class="mb-0 text-secondary">Total Properties</p>
                                <h4 class="my-1 text-danger">8</h4>
                                <p class="mb-0 font-13">Total properties</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                class='bx bxs-user-plus'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-success">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="">
                                <p class="mb-0 text-secondary">Total Transaction</p>
                                <h4 class="my-1 text-success">3</h4>
                                <p class="mb-0 font-13">Total Transaction</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class='bx bxs-book'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-warning">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="">
                                <p class="mb-0 text-secondary">Total Blog Post</p>
                                <h4 class="my-1 text-warning">3</h4>
                                <p class="mb-0 font-13">Total Blog Post</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                class='bx bxs-comment'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <!--end row-->

    <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Manage Sellers</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S/N</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sellers as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ !empty($item->photo) ? url('upload/seller_images/' . $item->photo) : url('upload/no_image2.jpeg') }}""
                                        class="product-img-2" alt="product img"></td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>${{ $item->phone }}</td>
                                <td>
                                    @if ($item->status == '1')
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                        <span class="badge rounded-pill bg-warning">Pending</span>
                                    @endif
                                </td>
                                <td class="d-flex">
                                    <a href="{{ route('change.status', $item->id) }}" class="btn btn-{{ $item->status === '0' ? 'success': 'warning'  }}">{{ $item->status === '0' ? 'Approve' : 'Pending'  }} </a> &nbsp;
                                    <a href=""
                                        class="btn btn-danger"> Delete </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--end row-->
    <!--end row-->

</div>
@endsection