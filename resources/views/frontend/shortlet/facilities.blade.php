@extends('frontend.master')

@section('home')

@include('components.progress-tracker', ['step' => 2])

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="text-center text-title">Step 2: Add Facilities</h3>
                    <form action="{{ route('shortlet.facilities.store', ['shortlet' => $shortlet->id]) }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="facilities">Facilities:</label>
                            <div class="row">
                                @foreach($facilities as $facility)
                                    <div class="col-md-4">
                                        <div class="form-check">
                                            <input
                                                type="checkbox"
                                                name="facilities[]"
                                                value="{{ $facility->id }}"
                                                id="facility-{{ $facility->id }}"
                                                class="form-check-input"
                                                {{ $hotel->facilities->contains($facility->id) ? 'checked' : '' }}
                                            >
                                            <label for="facility-{{ $facility->id }}" class="form-check-label">
                                                {{ $facility->name }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a href="{{route('shortlet.create')}}" class="theme-btn btn-one bg-danger text-decoration-none mr-5" id="backButton">Back</a>
                            <button class="theme-btn btn-one" type="submit" id="nextButton">Next</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
