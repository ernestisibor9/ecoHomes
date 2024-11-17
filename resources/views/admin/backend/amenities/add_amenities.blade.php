@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Add Property amenities
@endsection

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h6 class="mb-0 text-uppercase">Add Amenities</h6>
            <hr>
            <form action="{{ route('store.amenities') }}" method="post">
                @csrf

                <div class="card">
                    <div class="card-body">

                        <input amenities='text'
                            class= 'form-control mb-3  @error('amenities_name')
                          is-invalid
                          @enderror'
                            name= 'amenities_name' placeholder='Swimming pool' required />
                        <div>
                            @error('amenities_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
