@extends('frontend.master')

@section('home')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <style>
        .see {
            display: block !important;
        }

        .nice-select {
            display: none !important;
        }

        .progress-bar-animated {
            transition: width 0.5s ease-in-out;
        }
    </style>
    <div>
        {{-- GUEST PAYMENT - <div>
            <h2>Payment Summary</h2>
            <p>Email: {{ $email }}</p>
            <p>Room Reserved: {{ $roomDetails->property_name }}</p>
            <p>Room Number: {{ $roomDetails->room_number }}</p>
            <p>Room Type: {{ $roomDetails->room_size }}</p>
            <p>Total Price: {{ $totalPrice }}</p>
        </div> --}}

    </div>

    <div class="card mx-auto shadow-lg mt-5 mb-5" style="max-width: 700px;">
        <div class="card-body">
            <form id="paymentForm">
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" readonly id="email"
                        value="{{ $userData->email }}">
                </div>

                <!-- Room Number -->
                <div class="mb-3">
                    <label for="roomNumber" class="form-label">Room Number</label>
                    <input type="text" name="room_number" class="form-control" readonly id="roomNumber"
                        value="{{ $roomDetails->room_number }}">
                </div>

                <!-- Room Type -->
                <div class="mb-3">
                    <label for="roomType" class="form-label">Room Type</label>
                    <input type="text" name="room_type" class="form-control" readonly id="roomType"
                        value="{{ $roomDetails->room_size }}">
                </div>

                <div class="mb-3">
                    <label for="fullName" class="form-label">Total Price</label>
                    <input type="text" name="total_price" class="form-control" readonly id=""
                        value="{{ $totalPrice }}">
                </div>


                <!-- Submit Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary w-100 mb-3">Pay By PayPal</button>
                    <button type="submit" class="btn btn-success w-100 mb-3">Pay By PayStack</button>
                    <button type="submit" class="btn btn-danger w-100 mb-3">Pay By Google Pay</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Toast Notification -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1055;">
        <div id="toast" class="toast align-items-center text-white bg-success border-0" role="alert"
            aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body"></div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const fullName = document.getElementById('fullName').value.trim();
            const email = document.getElementById('email').value.trim();
            const roomType = document.getElementById('roomType').value;
            const cardNumber = document.getElementById('cardNumber').value.trim();
            const expiryDate = document.getElementById('expiryDate').value.trim();
            const cvv = document.getElementById('cvv').value.trim();

            if (!fullName || !email || !roomType || !cardNumber || !expiryDate || !cvv) {
                showToast('danger', 'Please fill in all fields.');
                return;
            }

            // Simulate payment success
            showToast('success', 'Payment processed successfully. Thank you!');
            setTimeout(() => {
                window.location.href = '/thank-you';
            }, 2000);
        });

        function showToast(type, message) {
            const toastEl = document.getElementById('toast');
            const toastBody = toastEl.querySelector('.toast-body');

            toastBody.textContent = message;
            toastEl.classList.remove('bg-success', 'bg-danger');
            toastEl.classList.add(type === 'success' ? 'bg-success' : 'bg-danger');
            const toast = new bootstrap.Toast(toastEl);
            toast.show();
        }
    </script>
@endsection
