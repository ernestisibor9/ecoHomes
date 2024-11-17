@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Add Property
@endsection

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Property Details</h6>
            <hr>
            <div class="card">
                <div class="card-body p-4">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <tbody>
                            <tr>
                                <td>Proprty Name</td>
                                <td>{{$property->property_name}}</td>
                            </tr>
                            <tr>
                                <td>Proprty Type</td>
                                <td>{{$property->type->type_name}}</td>
                            </tr>
                            <tr>
                                <td>Proprty Status</td>
                                <td>{{$property->property_status}}</td>
                            </tr>
                            <tr>
                                <td>Bedrooms</td>
                                <td>{{$property->bedrooms}}</td>
                            </tr>
                            <tr>
                                <td>Bathrooms</td>
                                <td>{{$property->bathrooms}}</td>
                            </tr>
                            <tr>
                                <td>Garage</td>
                                <td>{{$property->garage}}</td>
                            </tr>
                            <tr>
                                <td>Price</td>
                                <td>{{$property->price}}</td>
                            </tr>
                            <tr>
                                <td>Property Code</td>
                                <td>{{$property->property_code}}</td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>{{$property->city}}</td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>{{ucfirst($property->country)}}</td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>{{$property->address}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h6 class="mb-0 text-uppercase">Property Details</h6>
            <hr>
            <div class="card">
                <div class="card-body p-4">
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <tbody>
                            <tr>
                                <td>Main Image</td>
                                <td>
                                    <img src="{{asset($property->property_thumbnail)}}" alt="" width="120px" height="100px">
                                </td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>
                                    @if ($property->status === '1')
                                        <span class="badge rounded-pill bg-success">Active</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Inactive</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td>Amenities</td>
                                <td>
                                    <select class="form-select" name="amenities_id[]" id="multiple-select-field"
                                    data-placeholder="Select Ameities" multiple required>
                                    @foreach ($amenities as $amenity)
                                        <option value="{{ $amenity->id }}"
                                            {{ in_array($amenity->id, $property_amen) ? 'selected' : '' }}>
                                            {{ $amenity->amenities_name }}
                                        </option>
                                    @endforeach
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Short Description</td>
                                <td>{{ $property->short_description }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection
