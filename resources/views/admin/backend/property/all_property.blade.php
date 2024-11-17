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
                            <th>Image</th>
                            <th>Name</th>
                            <th>Property Type</th>
                            <th>Property Status</th>
                            <th>City</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($properties as $key => $property)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <th><img src="{{asset($property->property_thumbnail)}}" alt="" width="80px" height="70px"></th>
                                <td>{{ $property->property_name }}</td>
                                <td>{{ $property->type->type_name }}</td>
                                <td>{{ $property->property_status}}</td>
                                <td>{{ $property->city}}</td>
                                <td>
                                    @if ($property->status === '1')
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('change.status', $property->id) }}" class="btn btn-{{ $property->status === '0' ? 'success': 'danger'  }}">{{ $property->status === '0' ? 'Active' : 'Inactive'  }} </a> &nbsp;
                                    <a href="{{ route('property.details', $property->id) }}" title="Edit"
                                        class="btn btn-warning">Details</a>
                                    <a href="{{ route('property.edit', $property->id) }}" title="Edit"
                                        class="btn btn-primary">Edit</a>
                                    <a href="{{ route('property.delete', $property->id) }}" title="Delete"
                                        class="btn btn-danger" id="delete">Delete</a>
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
                                    placeholder='E.g Swimming pool'/>
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
