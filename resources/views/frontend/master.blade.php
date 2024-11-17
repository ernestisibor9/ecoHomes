<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="csrf-token" content="{{ csrf_token() }}">


<title>EcoHomes - HTML 5 Template Preview</title>

<!-- Fav Icon -->
<link rel="icon" href="{{asset('frontend/assets/images/favicon.ico')}}" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<!-- Stylesheets -->

<link href="{{asset('frontend/assets/css/font-awesome-all.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/flaticon.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/owl.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/bootstrap.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/jquery.fancybox.min.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/animate.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/jquery-ui.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/nice-select.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/color/theme-color.css')}}" id="jssDefault" rel="stylesheet">
<link href="{{asset('frontend/assets/css/switcher-style.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/style.css')}}" rel="stylesheet">
<link href="{{asset('frontend/assets/css/responsive.css')}}" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">

</head>


<!-- page wrapper -->
<body>

    <div class="boxed_wrapper">
                <!-- preloader -->
                <div class="loader-wrap">
                    <div class="preloader">
                        <div class="preloader-close"><i class="far fa-times"></i></div>
                        <div id="handle-preloader" class="handle-preloader">
                            <div class="animation-preloader">
                                <div class="spinner"></div>
                                <div class="txt-loading">
                                    <span data-text-preloader="e" class="letters-loading">
                                        e
                                    </span>
                                    <span data-text-preloader="c" class="letters-loading">
                                        c
                                    </span>
                                    <span data-text-preloader="o" class="letters-loading">
                                        o
                                    </span>
                                    <span data-text-preloader="h" class="letters-loading">
                                        h
                                    </span>
                                    <span data-text-preloader="o" class="letters-loading">
                                        o
                                    </span>
                                    <span data-text-preloader="m" class="letters-loading">
                                        m
                                    </span>
                                    <span data-text-preloader="e" class="letters-loading">
                                        e
                                    </span>
                                    <span data-text-preloader="s" class="letters-loading">
                                        s
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- preloader end -->

        <!-- main header -->
        @include('frontend.body.header')
        <!-- main-header end -->

        <!--- home -->
        @yield('home')
        <!--- home -->


        <!-- main-footer -->
        @include('frontend.body.footer')
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>


    <!-- jequery plugins -->
    <script src="{{asset('frontend/assets/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/owl.js')}}"></script>
    <script src="{{asset('frontend/assets/js/wow.js')}}"></script>
    <script src="{{asset('frontend/assets/js/validation.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.fancybox.js')}}"></script>
    <script src="{{asset('frontend/assets/js/appear.js')}}"></script>
    <script src="{{asset('frontend/assets/js/scrollbar.js')}}"></script>
    <script src="{{asset('frontend/assets/js/isotope.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.nice-select.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jQuery.style.switcher.min.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery-ui.js')}}"></script>
    <script src="{{asset('frontend/assets/js/jquery.paroller.min.js')}}"></script>


    <!-- main-js -->
    <script src="{{asset('frontend/assets/js/script.js')}}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
            case 'info':
                toastr.info(" {{ Session::get('message') }} ");
                break;

            case 'success':
                toastr.success(" {{ Session::get('message') }} ");
                break;

            case 'warning':
                toastr.warning(" {{ Session::get('message') }} ");
                break;

            case 'error':
                toastr.error(" {{ Session::get('message') }} ");
                break;
        }
    @endif
</script>

</body><!-- End of .page_wrapper -->
</html>
