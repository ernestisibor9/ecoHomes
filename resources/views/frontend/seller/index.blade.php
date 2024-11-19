@extends('frontend.seller.seller_dashboard')

@section('seller')

@section('title')
    EcoHomes - Seller Dashboard
@endsection

@php
    $userProgress = App\Models\UserProgress::where('user_id', Auth::user()->id)->first();
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
                    <h6 class="mb-0">Property Tracking</h6>
                </div>

            </div>
        </div>
        <div class="card-body">
                {{-- @foreach($userProgress as $key => $user)
                    <h3>{{$user->status}}</h3>
                @endforeach --}}
                @if(!empty($userProgress))
                <h3><strong>STATUS:</strong> &nbsp;&nbsp;&nbsp; {{ucfirst($userProgress->status)}}</h3>
                @else
                    <h4><strong>STATUS:</strong> &nbsp;&nbsp;&nbsp; No record yet for tracking </h4>
                @endif

        </div>
    </div>

    <!--end row-->
    <!--end row-->

</div>
@endsection
