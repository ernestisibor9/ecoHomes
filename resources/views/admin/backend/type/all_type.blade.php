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
            <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Property Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $key => $type)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $type->type_name }}</td>
                                <td>
                                    <a href="{{ route('type.edit', $type->id) }}" title="Edit"
                                        class="btn btn-primary">Edit</a>
                                    <a href="{{ route('type.delete', $type->id) }}" title="Delete"
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Property Type</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('store.type') }}" method="post">
                                @csrf

                                <input type='text' class= 'form-control mb-3' name= 'type_name'
                                    placeholder='E.g duplex' required />
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
