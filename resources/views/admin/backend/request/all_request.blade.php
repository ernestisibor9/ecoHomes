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
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Name</th>
                            <th>Property Type</th>
                            <th>Property Status</th>
                            <th>Budget</th>
                            <th>Personality</th>
                            <th>Country</th>
                            <th>State/County</th>
                            <th>City</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $key => $property)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $property->name }}</td>
                                <td>{{ $property->property_type }}</td>
                                <td>{{ $property->property_status }}</td>
                                <td>{{ number_format($property->budget, 2) }}</td>
                                <td>{{ $property->personality }}</td>
                                <td>{{ $property->country->name }}</td>
                                <td>{{ $property->state->name }}</td>
                                <td>{{ $property->city->name }}</td>
                                <td>
                                    <a href="#" class="btn btn-success">View Request</a>
                                </td>
                            </tr>
            </div>
            @endforeach
            </tbody>
            </table>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Property amenity</h5>
                            <button amenity="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('store.amenities') }}" method="post">
                                @csrf

                                <input type='text' class= 'form-control mb-3' name= 'amenities_name'
                                    placeholder='E.g Swimming pool' />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
</div>

@endsection
