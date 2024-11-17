@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Add Property Type
@endsection

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h6 class="mb-0 text-uppercase">Add Property Type</h6>
            <hr>
            <form action="{{ route('store.type') }}" method="post">
                @csrf

                <div class="card">
                    <div class="card-body">
                        {{-- <select class="form-select mb-3 @error('type_name')
                          is-invalid
                          @enderror" name="type_name" aria-label="Default select example">
								<option selected="" disabled>Select Property Type</option>
								<option value="duplex">Duplex</option>
								<option value="luxury">Luxury Apartment </option>
								<option value="2 bedroom">2 Bedroom</option>
								<option value="3 bedroom">3 Bedroom</option>
								<option value="studio apartment">Studio Apartment</option>
								<option value="townhouse">Townhouse</option>
								<option value="mansion">Mansion</option>
								<option value="other">Other</option>
							</select> --}}
                        <input type='text'
                            class= 'form-control mb-3  @error('type_name')
                          is-invalid
                          @enderror'
                            name= 'type_name' placeholder='E.g duplex' required />
                        <div>
                            @error('type_name')
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
