@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Edit Amenities
@endsection

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h6 class="mb-0 text-uppercase">Edit Amenities</h6>
            <hr>
            <form action="{{ route('update.amenities') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $editAmenities->id }}">
                <div class="card">
                    <div class="card-body">

                        <input Amenities='text'
                            class= 'form-control mb-3'
                            name= 'amenities_name' placeholder='E.g swimming pool' value="{{$editAmenities->amenities_name}}"/>

                        <div class="mt-3">
                            <button Amenities="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
