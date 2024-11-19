@extends('frontend.seller_dashboard')

@section('frontend_seller')

@section('title')
    Cedar - Seller Dashboard
@endsection

@php
    $userProgress = App\Models\userProgress::latest()->get();
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

    <h1>Seller Dashboard</h1>
</div>
</div>
</div>

<!--end row-->
<!--end row-->

</div>
@endsection
