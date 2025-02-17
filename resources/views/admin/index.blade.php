@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    EcoHomes - Admin Dashboard
@endsection


<style>
    #activityChart {
        max-width: 100%;
        height: 300px !important;
    }
</style>


{{-- @php
    $registeredStudents = App\Models\User::where('role', 'user')->get();
    $enrollStudents = App\Models\Payment::latest()->get();
    $totalCourses = App\Models\Course::latest()->get();
    $blogPost = App\Models\BlogPost::latest()->get();
    $payment = App\Models\Payment::latest()->get();
@endphp --}}

@php
     $registeredUsers = App\Models\User::where('role', 'user')->get();
     $listProperty = App\Models\ListProperty::latest()->get();
     $flat = App\Models\ListProperty::where('property_type', 'flat')->get();
     $house = App\Models\ListProperty::where('property_type', 'house')->get();
     $land = App\Models\ListProperty::where('property_type', 'land')->get();
     $commercial = App\Models\ListProperty::where('property_type', 'commercial_property')->get();
     $propertyView = App\Models\PropertyView::latest()->get();
     $buy = App\Models\ListProperty::where('property_status', 'buy')->get();
     $rent = App\Models\ListProperty::where('property_status', 'rent')->get();
     $sell = App\Models\ListProperty::where('property_status', 'sell')->get();
     $lease = App\Models\ListProperty::where('property_status', 'lease')->get();
@endphp


<div class="page-content">
    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="">
                                <p class="mb-0 text-secondary">Registered Users</p>
                                <h4 class="my-1 text-info">{{count($registeredUsers)}}</h4>
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
                                <h4 class="my-1 text-danger">{{count($listProperty)}}</h4>
                                <p class="mb-0 font-13">Total properties</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                class='bx bxs-home'></i>
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
                                <p class="mb-0 text-secondary">Total Phone Click</p>
                                <h4 class="my-1 text-success" id="phoneClicks">0</h4>
                                <p class="mb-0 font-13">Total Phone Click</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class='bx bxs-phone'></i>
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
                                <p class="mb-0 text-secondary">Total Page Views</p>
                                <h4 class="my-1 text-warning" id="pageViews">0</h4>
                                <p class="mb-0 font-13">Total Page Views</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                class='bx bxs-book'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card radius-10 border-start border-0 border-4 border-info">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <a href="">
                                <p class="mb-0 text-secondary">Properties clicked</p>
                                <h4 class="my-1 text-info">{{count($propertyView)}}</h4>
                                <p class="mb-0 font-13">Total properties clicked</p>
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
                                <p class="mb-0 text-secondary">Total Visitors</p>
                                <h4 class="my-1 text-danger" id="online-users-count">0</h4>
                                <p class="mb-0 font-13">Total Visitors</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i
                                class='bx bxs-home'></i>
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
                                <p class="mb-0 text-secondary">Online Login Users</p>
                                <h4 class="my-1 text-success" id="online-users-count">0</h4>
                                <p class="mb-0 font-13">Total Online Users</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i
                                class='bx bxs-phone'></i>
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
                                <p class="mb-0 text-secondary">Flat Properties</p>
                                <h4 class="my-1 text-warning">{{count($flat)}}</h4>
                                <p class="mb-0 font-13">Total No. of Flats</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
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
                                <p class="mb-0 text-secondary">House Properties</p>
                                <h4 class="my-1 text-warning">{{count($house)}}</h4>
                                <p class="mb-0 font-13">Total No. of Houses</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
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
                                <p class="mb-0 text-secondary">Commercial Props</p>
                                <h4 class="my-1 text-warning">{{count($commercial)}}</h4>
                                <p class="mb-0 font-13">Total Commercial Props</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
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
                                <p class="mb-0 text-secondary">Land Properties</p>
                                <h4 class="my-1 text-warning">{{count($land)}}</h4>
                                <p class="mb-0 font-13">Total Land Properties</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
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
                                <p class="mb-0 text-secondary">Buy Properties</p>
                                <h4 class="my-1 text-warning">{{count($buy)}}</h4>
                                <p class="mb-0 font-13">Total Buy Properties</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
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
                                <p class="mb-0 text-secondary">Rent Properties</p>
                                <h4 class="my-1 text-warning">{{count($rent)}}</h4>
                                <p class="mb-0 font-13">Total Rent Properties</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
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
                                <p class="mb-0 text-secondary">Sell Properties</p>
                                <h4 class="my-1 text-warning">{{count($sell)}}</h4>
                                <p class="mb-0 font-13">Total Sell Properties</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
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
                                <p class="mb-0 text-secondary">Lease Properties</p>
                                <h4 class="my-1 text-warning">{{count($lease)}}</h4>
                                <p class="mb-0 font-13">Total Lease Properties</p>
                            </a>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-orange text-white ms-auto"><i
                                class='bx bxs-book'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

    <!--end row-->
{{--
    <div class="card radius-10">
        <div class="card-header">
            <div class="d-flex align-items-center">
                <div>
                    <h6 class="mb-0">Enrolled Students</h6>
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
                            <th>Course</th>
                            <th>Amount</th>
                            <th>Payment ID</th>
                            <th>Payment Method</th>
                            <th>Date of Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($payment as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td><img src="{{ !empty($item->user->photo) ? url('upload/user_images/' . $item->user->photo) : url('upload/no_image2.jpeg') }}""
                                        class="product-img-2" alt="product img"></td>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->course->course_name }}</td>
                                <td>${{ $item->amount }}</td>
                                <td>{{ $item->payment_id }}</td>
                                <td> <span
                                        class="badge bg-gradient-quepal text-white shadow-sm w-100">{{ $item->payment_method }}</span>
                                </td>
                                <td>{{ $item->created_at->format('M d Y') }} </td>
                            </tr>
                        @endforeach --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--end row-->
    <!--end row-->

</div>

<canvas id="activityChart" width="400" height="200" style="text-align: center; margin:auto;"></canvas>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/get-chart-data')
            .then(response => response.json())
            .then(data => {
                const ctx = document.getElementById('activityChart').getContext('2d');
                new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Phone Clicks', 'Page Views', 'Online Users'],
                        datasets: [{
                            label: 'User Activities',
                            data: [data.phoneClicks, data.pageViews, data.onlineUsers],
                            backgroundColor: ['blue', 'green', 'red']
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                labels: {
                                    font: {
                                        size: 20 // Increase legend font size
                                    }
                                }
                            },
                            tooltip: {
                                bodyFont: {
                                    size: 16 // Increase tooltip font size
                                },
                                titleFont: {
                                    size: 18 // Increase tooltip title font size
                                }
                            }
                        }
                    }
                });
            });
    });
    </script>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetch('/get-chart-data')
            .then(response => response.json())
            .then(data => {
                document.getElementById('phoneClicks').innerText = data.phoneClicks;
                document.getElementById('pageViews').innerText = data.pageViews;
                document.getElementById('onlineUsers').innerText = data.onlineUsers;
            })
            .catch(error => console.error('Error fetching chart data:', error));
    });
    </script>

<script>
    setInterval(() => {
        fetch('/online-users')
            .then(response => response.json())
            .then(data => {
                document.getElementById('online-users-count').innerText = data.online_users;
            });
    }, 5000); // Refresh every 5 seconds
    </script>

<script>
    setInterval(() => {
        fetch('/online-guests')
            .then(response => response.json())
            .then(data => {
                document.getElementById('online-guests-count').innerText = data.online_users;
            });
    }, 5000); // Refresh every 5 seconds
    </script>


@endsection
