@extends('admin.admin_dashboard')

@section('admin')

@section('title')
    PaddyHome Properties - Edit Property Type
@endsection

<div class="page-content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h6 class="mb-0 text-uppercase">Edit Property Type</h6>
            <hr>
            <form action="{{ route('update.type') }}" method="post">
                @csrf
                <input type="hidden" name="id" id="id" value="{{ $editTypes->id }}">
                <div class="card">
                    <div class="card-body">

                        <input type='text'
                            class= 'form-control mb-3'
                            name= 'type_name' placeholder='E.g duplex' value="{{$editTypes->type_name}}"/>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
