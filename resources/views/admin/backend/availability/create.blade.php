@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - All Property amenity
@endsection

<div class="page-content">
    <div class="mt-2 mb-4 d-flex justify-content-between">
        <span></span>

    </div>
    <div class="card">
        <div class="card-body">
            <h3 class="text-center card-title">Set Availability for {{ $property->property_name }} property</h3>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <form action="{{ route('availability.store', $property->id) }}" method="POST">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="availability_date">Start Date:</label>
                                <input type="date" name="start_date" id="availability_date"
                                    class="form-control
                                @error('start_date')is-invalid @enderror "
                                    required>
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="availability_date">End Date:</label>
                                <input type="date" name="end_date" id="availability_date"
                                    class="form-control
                                 @error('end_date')is-invalid @enderror"
                                    required>
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="availability_time">Start Time:</label>
                                <input type="time" name="start_time" id="availability_time" class="form-control"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="availability_time">End Time:</label>
                                <input type="time" name="end_time" id="availability_time" class="form-control"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    // Get the current date
    const now = new Date();

    // Format date as YYYY-MM-DD
    const year = now.getFullYear();
    const month = String(now.getMonth() + 1).padStart(2, '0');
    const day = String(now.getDate()).padStart(2, '0');

    const currentDate = `${year}-${month}-${day}`;

    // Set the min attribute for the input field
    document.getElementById('availability_date').setAttribute('min', currentDate);
</script>

@endsection
