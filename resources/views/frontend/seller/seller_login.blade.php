<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>Realshed - HTML 5 Template Preview</title>

    <!-- Fav Icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('frontend/assets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/switcher-style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive.css') }}" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">


</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">


        <!-- preloader -->
        {{-- <div class="loader-wrap">
            <div class="preloader">
                <div class="preloader-close"><i class="far fa-times"></i></div>
                <div id="handle-preloader" class="handle-preloader">
                    <div class="animation-preloader">
                        <div class="spinner"></div>
                        <div class="txt-loading">
                            <span data-text-preloader="r" class="letters-loading">
                                r
                            </span>
                            <span data-text-preloader="e" class="letters-loading">
                                e
                            </span>
                            <span data-text-preloader="a" class="letters-loading">
                                a
                            </span>
                            <span data-text-preloader="l" class="letters-loading">
                                l
                            </span>
                            <span data-text-preloader="s" class="letters-loading">
                                s
                            </span>
                            <span data-text-preloader="h" class="letters-loading">
                                h
                            </span>
                            <span data-text-preloader="e" class="letters-loading">
                                e
                            </span>
                            <span data-text-preloader="d" class="letters-loading">
                                d
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- preloader end -->


        <!-- switcher menu -->
        <div class="switcher">
            <div class="switch_btn">
                <button><i class="fas fa-palette"></i></button>
            </div>
            <div class="switch_menu">
                <!-- color changer -->
                <div class="switcher_container">
                    <ul id="styleOptions" title="switch styling">
                        <li>
                            <a href="javascript: void(0)" data-theme="green" class="green-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="pink" class="pink-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="violet" class="violet-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="crimson" class="crimson-color"></a>
                        </li>
                        <li>
                            <a href="javascript: void(0)" data-theme="orange" class="orange-color"></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- end switcher menu -->


        <!-- main header -->
        <header class="main-header">
            <header class="main-header ">
                <!-- header-top -->
                <div class="header-top">
                    <div class="top-inner clearfix">
                        <div class="left-column pull-left">
                            <ul class="info clearfix">
                                <li><i class="far fa-map-marker-alt"></i>Discover St, New York, NY 10012, USA</li>
                                <li><i class="far fa-clock"></i>Mon - Sat 9.00 - 18.00</li>
                                <li><i class="far fa-phone"></i><a href="tel:2512353256">+251-235-3256</a></li>
                            </ul>
                        </div>
                        <div class="right-column pull-right">
                            <ul class="social-links clearfix">
                                <li><a href="index.html"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="index.html"><i class="fab fa-twitter"></i></a></li>
                                <li><a href="index.html"><i class="fab fa-pinterest-p"></i></a></li>
                                <li><a href="index.html"><i class="fab fa-google-plus-g"></i></a></li>
                                <li><a href="index.html"><i class="fab fa-vimeo-v"></i></a></li>
                            </ul>
                            <div class="sign-box">
                                <a href="{{ route('register') }}"><i class="fas fa-user"></i>Sign Up</a> &nbsp;
                                <a href="{{ route('login') }}"><i class="fas fa-user"></i>Sign In</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- header-lower -->
                <div class="header-lower">
                    <div class="outer-box">
                        <div class="main-box">
                            <div class="logo-box">
                                <figure class="logo"><a href="index.html"><img
                                            src="{{ asset('frontend/assets/images/logo-2.png') }}"
                                            alt=""></a></figure>
                            </div>
                            <div class="menu-area clearfix">
                                <!--Mobile Navigation Toggler-->
                                <div class="mobile-nav-toggler">
                                    <i class="icon-bar"></i>
                                    <i class="icon-bar"></i>
                                    <i class="icon-bar"></i>
                                </div>
                                <nav class="main-menu navbar-expand-md navbar-light">
                                    <div class="collapse navbar-collapse show clearfix" id="navbarSupportedContent">
                                        <ul class="navigation clearfix">
                                            <li class="current "><a href="{{ url('/') }}"><span>Home</span></a>
                                                {{-- <ul>
                                                    <li><a href="index.html">Main Home</a></li>
                                                    <li><a href="index-2.html">Home Modern</a></li>
                                                    <li><a href="index-3.html">Home Map</a></li>
                                                    <li><a href="index-4.html">Home Half Map</a></li>
                                                    <li><a href="index-5.html">Home Agent</a></li>
                                                    <li><a href="index-onepage.html">OnePage Home</a></li>
                                                    <li><a href="index-rtl.html">RTL Home</a></li>
                                                    <li class="dropdown"><a href="index.html">Header Style</a>
                                                        <ul>
                                                            <li><a href="index.html">Header Style 01</a></li>
                                                            <li><a href="index-2.html">Header Style 02</a></li>
                                                            <li><a href="index-3.html">Header Style 03</a></li>
                                                        </ul>
                                                    </li>
                                                </ul> --}}
                                            </li>
                                            {{-- <li><a href="#"><span>About</span></a></li> --}}
                                            {{-- <li class="dropdown"><a href="index.html"><span>Listing</span></a>
                                                <ul>
                                                    <li><a href="agents-list.html">Agents List</a></li>
                                                    <li><a href="agents-grid.html">Agents Grid</a></li>
                                                    <li><a href="agents-details.html">Agent Details</a></li>
                                                </ul>
                                            </li>
                                            <li class="dropdown"><a href="index.html"><span>Property</span></a>
                                                <ul>
                                                    <li><a href="property-list.html">Property List</a></li>
                                                    <li><a href="property-grid.html">Property Grid</a></li>
                                                    <li><a href="property-list-2.html">Property List Full View</a></li>
                                                    <li><a href="property-grid-2.html">Property Grid Full View</a></li>
                                                    <li><a href="property-list-3.html">Property List Half View</a></li>
                                                    <li><a href="property-grid-3.html">Property Grid Half View</a></li>
                                                    <li><a href="property-details.html">Property Details 01</a></li>
                                                    <li><a href="property-details-2.html">Property Details 02</a></li>
                                                    <li><a href="property-details-3.html">Property Details 03</a></li>
                                                    <li><a href="property-details-4.html">Property Details 04</a></li>
                                                </ul>
                                            </li> --}}
                                            {{-- <li class="dropdown"><a href="index.html"><span>Pages</span></a>
                                                <div class="megamenu">
                                                    <div class="row clearfix">
                                                        <div class="col-xl-4 column">
                                                            <ul>
                                                                <li><h4>Pages</h4></li>
                                                                <li><a href="about.html">About Us</a></li>
                                                                <li><a href="services.html">Our Services</a></li>
                                                                <li><a href="faq.html">Faq's Page</a></li>
                                                                <li><a href="pricing.html">Pricing Table</a></li>
                                                                <li><a href="compare-roperties.html">Compare Properties</a></li>
                                                                <li><a href="categories.html">Categories Page</a></li>
                                                                <li><a href="career.html">Career Opportunity</a></li>
                                                                <li><a href="testimonials.html">Testimonials</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-xl-4 column">
                                                            <ul>
                                                                <li><h4>Pages</h4></li>
                                                                <li><a href="gallery.html">Our Gallery</a></li>
                                                                <li><a href="profile.html">My Profile</a></li>
                                                                <li><a href="signin.html">Sign In</a></li>
                                                                <li><a href="signup.html">Sign Up</a></li>
                                                                <li><a href="error.html">404</a></li>
                                                                <li><a href="agents-list.html">Agents List</a></li>
                                                                <li><a href="agents-grid.html">Agents Grid</a></li>
                                                                <li><a href="agents-details.html">Agent Details</a></li>
                                                            </ul>
                                                        </div>
                                                        <div class="col-xl-4 column">
                                                            <ul>
                                                                <li><h4>Pages</h4></li>
                                                                <li><a href="blog-1.html">Blog 01</a></li>
                                                                <li><a href="blog-2.html">Blog 02</a></li>
                                                                <li><a href="blog-3.html">Blog 03</a></li>
                                                                <li><a href="blog-details.html">Blog Details</a></li>
                                                                <li><a href="agency-list.html">Agency List</a></li>
                                                                <li><a href="agency-grid.html">Agency Grid</a></li>
                                                                <li><a href="agency-details.html">Agency Details</a></li>
                                                                <li><a href="contact.html">Contact Us</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li> --}}
                                            {{-- <li class="dropdown"><a href="index.html"><span>Agency</span></a>
                                                <ul>
                                                    <li><a href="agency-list.html">Agency List</a></li>
                                                    <li><a href="agency-grid.html">Agency Grid</a></li>
                                                    <li><a href="agency-details.html">Agency Details</a></li>
                                                </ul>
                                            </li> --}}
                                            <li class=""><a href="index.html"><span>Blog</span></a>
                                                {{-- <ul>
                                                    <li><a href="blog-1.html">Blog 01</a></li>
                                                    <li><a href="blog-2.html">Blog 02</a></li>
                                                    <li><a href="blog-3.html">Blog 03</a></li>
                                                    <li><a href="blog-details.html">Blog Details</a></li>
                                                </ul> --}}
                                            </li>
                                            <li><a href="contact.html"><span>Contact</span></a></li>
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                            <div class="btn-box">
                                <a href="index.html" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                            </div>
                        </div>
                    </div>
                </div>

                <!--sticky Header-->
                <div class="sticky-header">
                    <div class="outer-box">
                        <div class="main-box">
                            <div class="logo-box">
                                <figure class="logo"><a href="index.html"><img
                                            src="{{ asset('frontend/assets/images/logo-2.png') }}"
                                            alt=""></a></figure>
                            </div>
                            <div class="menu-area clearfix">
                                <nav class="main-menu clearfix">
                                    <!--Keep This Empty / Menu will come through Javascript-->
                                </nav>
                            </div>
                            <div class="btn-box">
                                <a href="index.html" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </header>
        <!-- main-header end -->

        <!-- Mobile Menu  -->
        <div class="mobile-menu">
            <div class="menu-backdrop"></div>
            <div class="close-btn"><i class="fas fa-times"></i></div>

            <nav class="menu-box">
                <div class="nav-logo"><a href="index.html"><img src="assets/images/logo-2.png" alt=""
                            title=""></a></div>
                <div class="menu-outer">
                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                </div>
                <div class="contact-info">
                    <h4>Contact Info</h4>
                    <ul>
                        <li>Chicago 12, Melborne City, USA</li>
                        <li><a href="tel:+8801682648101">+88 01682648101</a></li>
                        <li><a href="mailto:info@example.com">info@example.com</a></li>
                    </ul>
                </div>
                <div class="social-links">
                    <ul class="clearfix">
                        <li><a href="index.html"><span class="fab fa-twitter"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-facebook-square"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-pinterest-p"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-instagram"></span></a></li>
                        <li><a href="index.html"><span class="fab fa-youtube"></span></a></li>
                    </ul>
                </div>
            </nav>
        </div><!-- End Mobile Menu -->


        <!--Page Title-->
        <section class="page-title-two bg-color-1 centred">
            <div class="pattern-layer">
                <div class="pattern-1" style="background-image: url(assets/images/shape/shape-9.png);"></div>
                <div class="pattern-2" style="background-image: url(assets/images/shape/shape-10.png);"></div>
            </div>
            <div class="auto-container">
                <div class="content-box clearfix">
                    <h1>Sign In</h1>
                    <ul class="bread-crumb clearfix">
                        <li><a href="index.html">Home</a></li>
                        <li>Sign In</li>
                    </ul>
                </div>
            </div>
        </section>
        <!--End Page Title-->


        <!-- ragister-section -->
        <section class="ragister-section centred sec-pad">
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-xl-8 col-lg-12 col-md-12 offset-xl-2 big-column">
                        <div class="sec-title">
                            <h5>Login</h5>
                            <h2>Sign In With EcoHomes</h2>
                        </div>
                        <div class="tabs-box">
                            {{-- <div class="tab-btn-box">
                                <ul class="tab-btns tab-buttons centred clearfix">
                                    <li class="tab-btn active-btn" data-tab="#tab-1">Agent</li>
                                    <li class="tab-btn" data-tab="#tab-2">User</li>
                                </ul>
                            </div> --}}
                            <div class="tabs-content">
                                <div class="tab active-tab" id="tab-1">
                                    <div class="inner-box">
                                        <h4>Login</h4>
                                        <form action="{{ route('login') }}" method="post" class="default-form">
                                            @csrf
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" name="email" required=""
                                                    class="form-control
                                                @error('email')is-invalid @enderror">
                                                @error('email')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="password" required=""
                                                    class="form-control
                                                @error('password')is-invalid @enderror ">
                                                @error('password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Login</button>
                                            </div>
                                        </form>
                                        <div class="othre-text">
                                            <p>Don't have an account? <a href="{{route('seller.signup')}}">Sign up</a></p>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="tab" id="tab-2">
                                    <div class="inner-box">
                                        <h4>Sign up</h4>
                                        <form action="signin.html" method="post" class="default-form">
                                            <div class="form-group">
                                                <label>User name</label>
                                                <input type="text" name="name" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Email address</label>
                                                <input type="email" name="email" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>New Password</label>
                                                <input type="password" name="name" required="">
                                            </div>
                                            <div class="form-group">
                                                <label>Confirm Password</label>
                                                <input type="password" name="name" required="">
                                            </div>
                                            <div class="form-group message-btn">
                                                <button type="submit" class="theme-btn btn-one">Sign up</button>
                                            </div>
                                        </form>
                                        <div class="othre-text">
                                            <p>Already have an account? <a href="signin.html">Sign in</a></p>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- ragister-section end -->


        <!-- subscribe-section -->
        <section class="subscribe-section bg-color-3">
            <div class="pattern-layer" style="background-image: url(assets/images/shape/shape-2.png);"></div>
            <div class="auto-container">
                <div class="row clearfix">
                    <div class="col-lg-6 col-md-6 col-sm-12 text-column">
                        <div class="text">
                            <span>Subscribe</span>
                            <h2>Sign Up To Our Newsletter To Get The Latest News And Offers.</h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 form-column">
                        <div class="form-inner">
                            <form action="contact.html" method="post" class="subscribe-form">
                                <div class="form-group">
                                    <input type="email" name="email" placeholder="Enter your email"
                                        required="">
                                    <button type="submit">Subscribe Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-section end -->


        <!-- main-footer -->
        <footer class="main-footer">
            <div class="footer-top bg-color-2">
                <div class="auto-container">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget about-widget">
                                <div class="widget-title">
                                    <h3>About</h3>
                                </div>
                                <div class="text">
                                    <p>Lorem ipsum dolor amet consetetur adi pisicing elit sed eiusm tempor in cididunt
                                        ut labore dolore magna aliqua enim ad minim venitam</p>
                                    <p>Quis nostrud exercita laboris nisi ut aliquip commodo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget links-widget ml-70">
                                <div class="widget-title">
                                    <h3>Services</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="links-list class">
                                        <li><a href="index.html">About Us</a></li>
                                        <li><a href="index.html">Listing</a></li>
                                        <li><a href="index.html">How It Works</a></li>
                                        <li><a href="index.html">Our Services</a></li>
                                        <li><a href="index.html">Our Blog</a></li>
                                        <li><a href="index.html">Contact Us</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget post-widget">
                                <div class="widget-title">
                                    <h3>Top News</h3>
                                </div>
                                <div class="post-inner">
                                    <div class="post">
                                        <figure class="post-thumb"><a href="blog-details.html"><img
                                                    src="assets/images/resource/footer-post-1.jpg" alt=""></a>
                                        </figure>
                                        <h5><a href="blog-details.html">The Added Value Social Worker</a></h5>
                                        <p>Mar 25, 2020</p>
                                    </div>
                                    <div class="post">
                                        <figure class="post-thumb"><a href="blog-details.html"><img
                                                    src="assets/images/resource/footer-post-2.jpg" alt=""></a>
                                        </figure>
                                        <h5><a href="blog-details.html">Ways to Increase Trust</a></h5>
                                        <p>Mar 24, 2020</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 footer-column">
                            <div class="footer-widget contact-widget">
                                <div class="widget-title">
                                    <h3>Contacts</h3>
                                </div>
                                <div class="widget-content">
                                    <ul class="info-list clearfix">
                                        <li><i class="fas fa-map-marker-alt"></i>Flat 20, Reynolds Neck, North
                                            Helenaville, FV77 8WS</li>
                                        <li><i class="fas fa-microphone"></i><a href="tel:23055873407">+2(305)
                                                587-3407</a></li>
                                        <li><i class="fas fa-envelope"></i><a
                                                href="mailto:info@example.com">info@example.com</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="auto-container">
                    <div class="inner-box clearfix">
                        <figure class="footer-logo"><a href="index.html"><img src="assets/images/footer-logo.png"
                                    alt=""></a></figure>
                        <div class="copyright pull-left">
                            <p><a href="index.html">Realshed</a> &copy; 2021 All Right Reserved</p>
                        </div>
                        <ul class="footer-nav pull-right clearfix">
                            <li><a href="index.html">Terms of Service</a></li>
                            <li><a href="index.html">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>


    <!-- jequery plugins -->
    <script src="{{ asset('frontend/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/validation.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/appear.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/product-filter.js') }}"></script>

    <!-- map script -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA-CE0deH3Jhj6GN4YvdCFZS7DpbXexzGU"></script>
    <script src="{{ asset('frontend/assets/js/gmaps.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/map-helper.js') }}"></script>

    <!-- main-js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>


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
