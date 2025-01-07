@extends('frontend.master')

@section('home')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center clearfix">
            <div class="col-md-8">
                <h1>Verify OTP</h1>
                <p>We have sent an OTP to your email: <strong>{{ $email }}</strong></p>
                <form action="{{ route('guest.verifyOtpForm') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP:</label>
                        <input type="text" id="otp" name="otp" class="form-control" placeholder="Enter OTP"
                            required>
                    </div>
                    @if ($errors->has('otp'))
                        <div class="alert alert-danger">
                            {{ $errors->first('otp') }}
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Verify</button>
                </form>
            </div>
        </div>
    </div>
@endsection
