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
                                <th>Property Owner</th>
                                <th>Current Step</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($properties as $key => $property)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $property->user->name }}</td>
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
                                            <!-- Approve Button -->
                                            <form method="POST" action="{{ route('change.status3', ['id' => $property->id, 'status' => 'approved']) }}" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>

                                            <!-- Reject Button -->
                                            <button class="btn btn-danger" onclick="showRejectModal({{ $property->id }})">Reject</button>
                                        @elseif ($property->status === 'approved')
                                            <!-- Reject Button -->
                                            <button class="btn btn-danger" onclick="showRejectModal({{ $property->id }})">Reject</button>
                                        @elseif ($property->status === 'rejected')
                                            <!-- Approve Button -->
                                            <form method="POST" action="{{ route('change.status3', ['id' => $property->id, 'status' => 'approved']) }}" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            </form>
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

            <!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="{{ route('change.status3', ['id' => '__PROPERTY_ID__', 'status' => 'rejected']) }}" id="rejectForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="rejectModalLabel">Reject Property</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="rejectionMessage">Reason for Rejection</label>
                        <textarea name="message" id="rejectionMessage" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Send Rejection</button>
                </div>
            </form>
        </div>
    </div>
</div>

        </div>
    </div>
</div>
</div>

<script>
    function showRejectModal(propertyId) {
    const form = document.getElementById('rejectForm');
    const action = form.getAttribute('action').replace('__PROPERTY_ID__', propertyId);
    form.setAttribute('action', action);
    const rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
    rejectModal.show();
}

</script>

@endsection
