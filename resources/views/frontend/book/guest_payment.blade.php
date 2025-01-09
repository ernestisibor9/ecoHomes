<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment for Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">Payment for Room</h1>
        <p class="text-center text-muted">Complete the form below to proceed with your payment.</p>

        <div>
            GUEST PAYMENT - <div>
                <h2>Payment Summary</h2>
                <p>Email: {{ $email }}</p>
                <p>Room Reserved: {{ $roomDetails->property_name }}</p>
                <p>Check-In: {{ $roomDetails['check_in'] }}</p>
                <p>Check-Out: {{ $roomDetails['check_out'] }}</p>
                <p>Total Price: {{ $totalPrice }}</p>
            </div>

        </div>

        <div class="card mx-auto shadow-lg" style="max-width: 500px;">
            <div class="card-body">
                <form id="paymentForm">
                    <!-- Full Name -->
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" placeholder="Enter your full name"
                            required>
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email"
                            required>
                    </div>

                    <!-- Room Details -->
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Room Type</label>
                        <select id="roomType" class="form-select" required>
                            <option value="" disabled selected>Select your room type</option>
                            <option value="standard">Standard Room - $100</option>
                            <option value="deluxe">Deluxe Room - $150</option>
                            <option value="suite">Suite - $200</option>
                        </select>
                    </div>

                    <!-- Payment Details -->
                    <h5 class="mt-4">Payment Details</h5>
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" placeholder="1234 5678 9012 3456"
                            maxlength="19" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label for="expiryDate" class="form-label">Expiry Date</label>
                            <input type="text" class="form-control" id="expiryDate" placeholder="MM/YY"
                                maxlength="5" required>
                        </div>
                        <div class="col">
                            <label for="cvv" class="form-label">CVV</label>
                            <input type="password" class="form-control" id="cvv" placeholder="123" maxlength="3"
                                required>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary w-100">Pay Now</button>
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
</body>

</html>
