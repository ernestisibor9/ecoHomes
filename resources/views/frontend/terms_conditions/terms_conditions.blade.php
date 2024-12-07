@extends('frontend.master')

@section('home')
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
    <style>
        .progress {
            height: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        .progress-bar-custom {
            background: linear-gradient(to right, #4caf50, #81c784);
            /* Green gradient */
            color: white;
            font-weight: bold;
        }
    </style>
      <style>
        .hidden {
          display: none;
        }
        .form-radio{
            display: flex;
            justify-content: center;
            margin: 20px 50px;
        }
      </style>


    <!-- Page Title -->
    <section class="page-title-two bg-color-1 centred">
        <div class="pattern-layer">
            <div class="pattern-1" style="background-image: url({{ asset('frontend/assets/images/shape/shape-9.png') }});">
            </div>
            <div class="pattern-2" style="background-image: url({{ asset('frontend/assets/images/shape/shape-10.png') }});">
            </div>
        </div>
        <div class="auto-container">
            <div class="content-box clearfix">
                <h1>Terms and Conditions</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>Terms and Conditions</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- End Page Title -->

    <!-- Register Section -->
    <div class="container-fluid mb-5 mt-5">
        <div class="row justify-content-center">
            <div class="col-md-9">

                <div class="card shadow p-3">
                    <div class="card-body">
                        <h1 class="card-title text-center">TERMS AND CONDITIONS</h1>
                        <h5 class="card-title mb-2">1. Introduction</h5>
                        <p>
                            Welcome to EcoHomes Properties Limited. By accessing or using our real estate
                            platform, you agree to comply with and be bound by these Terms and Conditions
                            . If you do not agree, you must refrain from using the Platform.
                        </p>
                        <h5 class="card-title mb-2">2. Eligibility</h5>
                        <ul>
                            <li>Users must be at least 18 years of age or the legal age in their jurisdiction to use our
                                services.</li>
                            <li>By using the Platform, you represent and warrant that all registration information you
                                submit is truthful and accurate.</li>
                        </ul>
                        <h5 class="card-title mb-2">3. Use of the Platform</h5>
                        <ul>
                            <li>The Platform allows users to list, search, and interact with property advertisements.</li>
                            <li>You agree to use the Platform only for lawful purposes and in accordance with these Terms.
                            </li>
                        </ul>
                        <h5 class="card-title mb-2">4. Listing</h5>
                        <ul>
                            <li>All property listings must be accurate, complete, and not misleading.</li>
                            <li>Users are prohibited from uploading content that is offensive, discriminatory, or violates
                                intellectual property rights.</li>
                        </ul>
                        <h5 class="card-title mb-2">5. User Obligations</h5>
                        <ul>
                            <li>Users must not engage in any fraudulent, deceptive, or illegal activity.</li>
                            <li>It is your responsibility to ensure that you have the legal right to list a property.</li>
                            <li>Users agree not to impersonate others or misrepresent their affiliation with any person or
                                entity.</li>
                        </ul>
                        <h5 class="card-title mb-2">6. Fees and Payments</h5>
                        <ul>
                            <li>Any applicable fees for listing properties or other services will be clearly stated on the
                                Platform.</li>
                            <li>Payments must be made through approved payment methods, and all fees are non-refundable
                                unless otherwise stated.</li>
                        </ul>
                        <h5 class="card-title mb-2">7. Intellectual Property</h5>
                        <ul>
                            <li>All content, trademarks, and logos on the Platform are the property of EcoHomes or its
                                licensors.</li>
                            <li>Users are prohibited from copying, modifying, distributing, or creating derivative works
                                from any content on the Platform without prior written consent.</li>
                        </ul>
                        <h5 class="card-title mb-2">8. Liability Disclaimer</h5>
                        <ul>
                            <li>We provide the Platform on an "as-is" and "as-available" basis.</li>
                            <li>We do not guarantee the accuracy, reliability, or availability of any content or listings.
                            </li>
                            <li>We are not liable for any direct, indirect, incidental, or consequential damages resulting
                                from your use of the Platform.</li>
                        </ul>
                        <h5 class="card-title mb-2">9. Termination</h5>
                        <p>
                            We reserve the right to terminate or suspend your account at any time without notice if we
                            believe you have violated these Terms or engaged in unlawful activity.
                        </p>
                        <h5 class="card-title mb-2">10. Privacy</h5>
                        <p>
                            Your use of the Platform is subject to our Privacy Policy, which outlines how we collect, use,
                            and protect your personal information
                        </p>
                        <h5 class="card-title mb-2">11. Governing Law</h5>
                        <p>
                            These Terms are governed by and construed in accordance with the laws of [Your Country/State].
                            Any disputes arising under these Terms shall be subject to the exclusive jurisdiction of the
                            courts in [Your City/Region].
                        </p>
                        <h5 class="card-title mb-2">12. Changes to the Terms</h5>
                        <p>
                            We reserve the right to modify these Terms at any time. Changes will be effective immediately
                            upon posting on the Platform. Continued use of the Platform constitutes acceptance of the
                            revised Terms..
                        </p>
                        <h5 class="card-title mb-2">13. Contact us</h5>
                        <p>
                            If you have any questions about these Terms, please contact us at:
                        </p>
                        <ul>
                            <li><strong>Email</strong> info@ecohomes.com</li>
                            <li><strong>Phone</strong> +234 806 014 3255</li>
                        </ul>
                        <div class="form-radio">
                            <form id="form">
                                <h5>Do you agree?</h5>
                                <label style="margin-right: 30px;">
                                  <input type="radio" name="decision" value="agree"
                                 > Agree
                                </label>
                                <label>
                                  <input type="radio" name="decision" value="decline"> Decline
                                </label>
                                <br><br>
                                <a href="{{url('/')}}"  id="cancel" class="hidden btn btn-danger">Back to Home</a>
                              </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Register Section End -->

    <script>
        document.addEventListener('DOMContentLoaded', () => {
          const form = document.getElementById('form');
          const cancelButton = document.getElementById('cancel');

          form.addEventListener('change', (event) => {
            if (event.target.name === 'decision') {
              const decision = event.target.value;

              if (decision === 'agree') {
                // Redirect to Laravel route
                window.location.href = "{{ route('agree.page') }}";
              } else if (decision === 'decline') {
                cancelButton.classList.remove('hidden');
              }
            }
          });
        });
      </script>

@endsection
