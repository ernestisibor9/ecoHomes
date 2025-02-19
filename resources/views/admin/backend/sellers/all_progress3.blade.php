@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - All Property Type
@endsection

<div class="page-content">
    <div class="mt-2 mb-4 d-flex justify-content-between">
        <span></span>
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Add
            Property Type</button>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="container">
                <h2>Pending Property Approvals</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($properties->count() > 0)
                    <table class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>UserID</th>
                                <th>Current Step</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($properties as $key => $property)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $property->user_id }}</td>
                                    <td>{{ $property->current_step }}</td>
                                    <td>
                                        @if ($property->status == 'approved')
                                            <span class="badge rounded-pill bg-success">Approved</span>
                                        @elseif($property->status == 'pending')
                                            <span class="badge rounded-pill bg-warning">Pending</span>
                                        @else
                                            <span class="badge rounded-pill bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            @if ($property->status === 'pending')
                                                <a href="{{ route('change.status3', ['id' => $property->id, 'status' => 'approved']) }}"
                                                   class="btn btn-success">Approve</a>
                                                <a href="{{ route('change.status3', ['id' => $property->id, 'status' => 'rejected']) }}"
                                                   class="btn btn-danger">Reject</a>
                                            @elseif ($property->status === 'approved')
                                                <a href="{{ route('change.status3', ['id' => $property->id, 'status' => 'pending']) }}"
                                                   class="btn btn-warning">Pending</a>
                                                <a href="{{ route('change.status3', ['id' => $property->id, 'status' => 'rejected']) }}"
                                                   class="btn btn-danger">Reject</a>
                                            @elseif ($property->status === 'rejected')
                                                <a href="{{ route('change.status3', ['id' => $property->id, 'status' => 'approved']) }}"
                                                   class="btn btn-success">Approve</a>
                                                <a href="{{ route('change.status3', ['id' => $property->id, 'status' => 'pending']) }}"
                                                   class="btn btn-warning">Pending</a>
                                            @endif
                                        </div>

                                        {{-- <a href="{{ route('change.status2', $property->id) }}"
                                            class="btn btn-{{ $property->status === 'pending' ? 'success' : 'warning' }}">{{ $property->status === 'pending' ? 'Approve' : 'Pending' }}
                                        </a> &nbsp; --}}
                                        <div>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No pending properties for approval.</p>
                @endif
            </div>
        </div>
    </div>
</div>
</div>

@endsection
