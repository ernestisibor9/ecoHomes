@extends('frontend.master')

@section('home')
    @include('components.progress-tracker', ['step' => 5])

    <div class="text-center p-2">
        <h2>Congratulations!</h2>
        <p>Your shortlet has been successfully listed.</p>
        <a href="{{ route('view.shortlet', ['shortlet' => $shortlet->id]) }}" class="btn btn-success">View Listings</a>
    </div>

    <div class="container text-justify mt-5">

        <h4 class="text-center">Policy</h4>
        <p>
            This policy is set at the property level – any changes made will apply to all rooms.
            Guests can cancel their bookings for free before 6 pm on the day of arrival. The guests will be charged cost of
            the first night if they cancel after this.
            Guests who cancel within 24 hours will have their cancellation fee waived
            Non-refundable rate plan
            Price and cancellation policy
        </p>
        <p>
            Guests will pay 10% less than the standard rate for a non-refundable rate
            Guests can't cancel their bookings for free anytime
            Weekly rate plan
            Price and cancellation policy
        </p>
        <p>
            Guests will pay 15% less than the standard rate when they book for at least 7 nights
            Guests can cancel their bookings for free before 6 pm on the day of arrival. The guests will be charged cost of
            the first night if they cancel after this (based on the standard rate cancellation policy).
        </p>
        <p>
            Payments
            How can your guests pay for their stay?
        </p>
        <p>
            Online, when they make a reservation. Booking.com will facilitate your guests’ payments with the Payments by
            Booking.com service.
        </p>
        <p>
            By credit card at my property
            How Payments by Booking.com works
            Your guest pays through Booking.com with more options like PayPal, WeChat Pay, and AliPay.
            We facilitate your guest’s payment. You don’t have to deal with fraud, chargebacks, or invalid cards.
            Booking.com sends payouts to you.You'll receive a bank transfer by the 15th of each month that covers all
            bookings with check-outs in
            the previous month.
        </p>
        <p>
            This policy is subject to change at any time. Please review the most recent version before booking.
            If you have any questions, please contact our customer service team at
            <a href="mailto:info@example.com">info@ecohomes.com</a>
        </p>
    </div>>
@endsection
