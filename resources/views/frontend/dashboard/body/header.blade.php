<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    const pusher = new Pusher('01d01f2b254eac705136', {
        cluster: 'eu',
        forceTLS: true,
    });
</script>

<!-- main header -->
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
                    @auth
                        <a href="{{ route('user.logout') }}"><i class="fas fa-user"></i> Logout</a>
                    @else
                        <a href="{{ url('register/user') }}"><i class="fas fa-user"></i> SignUp/Register</a> &nbsp;
                        <a href="{{ route('login') }}"><i class="fas fa-user"></i> Sign In</a>
                    @endauth
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
                                src="{{ asset('frontend/assets/images/logo-2.png') }}" alt=""></a></figure>
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
                                <li class=""><a href="#"><span>Blog</span></a>
                                <li class=""><a href="{{ route('request.property') }}"><span>Request</span></a>
                                    {{-- <ul>
                                                <li><a href="blog-1.html">Blog 01</a></li>
                                                <li><a href="blog-2.html">Blog 02</a></li>
                                                <li><a href="blog-3.html">Blog 03</a></li>
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                            </ul> --}}
                                </li>
                                <li><a href="contact.html"><span>Contact</span></a></li>
                                {{-- <li><a href="{{route('hotel.create')}}" class="theme-btn btn-one text-decoration-none"><span class="text-white"><span>+</span> List Your Property</span></a></li> --}}
                                <li class="current dropdown  text-decoration-none"><a href="index.html"><span>List Your
                                            Property</span></a>
                                    <ul>
                                        <li><a href="#" class="text-decoration-none">Hotel</a>
                                        </li>
                                        <li><a href="#" class="text-decoration-none">Shortlet</a></li>
                                        <li><a href="#" class="text-decoration-none">Advertise Property</a>
                                        </li>
                                        <li><a href="{{ route('apartment.flat') }}"
                                                class="text-decoration-none">Flat</a> </li>
                                        <li><a href="{{ route('apartment.house') }}"
                                                class="text-decoration-none">House</a> </li>
                                        <li><a href="{{ route('commercial.property') }}"
                                                class="text-decoration-none">Commercial Property</a>
                                        </li>
                                        <li><a href="{{ route('land.property') }}" class="text-decoration-none">Land &
                                                Plots </a>
                                        </li>
                                    </ul>
                        </div>
                    </nav>
                </div>
                {{-- <div class="btn-box">
                            <a href="index.html" class="theme-btn btn-one"><span>+</span>Add Listing</a>
                        </div> --}}
            </div>
        </div>
    </div>

    <!--sticky Header-->
    <div class="sticky-header">
        <div class="outer-box">
            <div class="main-box">
                <div class="logo-box">
                    <figure class="logo"><a href="index.html"><img
                                src="{{ asset('frontend/assets/images/logo-2.png') }}" alt=""></a></figure>
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
<!-- main-header end -->

<!-- Mobile Menu  -->
<div class="mobile-menu">
    <div class="menu-backdrop"></div>
    <div class="close-btn"><i class="fas fa-times"></i></div>

    <nav class="menu-box">
        <div class="nav-logo"><a href="index.html"><img src="{{ asset('frontend/assets/images/logo-1.png') }}"
                    alt="" title=""></a></div>
        <div class="menu-outer"><!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header--></div>
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
