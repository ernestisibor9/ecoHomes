<style>
    @media (max-width: 768px) {
        .video-background {
            display: none;
            /* Hide video on tablets and smaller devices */
        }

    }


    /* Content Styling */
    .content {
        position: relative;
        color: white;
        text-align: center;
        padding: 20px;
        z-index: 2;
        margin-top: -295px;
    }

    /* .content h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 10px;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8);
    } */

    .content p {
        /* font-size: 1.5rem;
        line-height: 1.7;
        margin-bottom: 30px; */
        color: #fff;
    }

    .content h3 {
        color: #fff;
        font-size: 1.1rem;
    }

    .content .card {
        width: 75%;
        margin: 5px auto;
        /* Added more spacing between cards */
    }

    .content .card {
        background-color: rgba(0, 0, 0, 0.7);
        /* background-color: rgba(255, 255, 255, 0.9); */
        border-radius: 15px;
        overflow: hidden;
        margin: 5px 0;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .content .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* .content .card img {
        max-width: 100%;
        height: auto;
        display: block;
    } */

    /* Tablet Responsiveness */
    @media (max-width: 768px) {
        .content {
            margin-top: 100px;
            /* Increased spacing to push content below the menubar */
        }

        .content h1 {
            font-size: 2rem;
        }
    }

    /* Mobile Responsiveness */
    @media (max-width: 480px) {
        .content {
            margin-top: 12px;
            /* Further increased spacing for mobile devices */
            padding: 10px;
        }

        .content h1 {
            font-size: 1.8rem;
        }

        .content .card {
            margin: 5px auto;
            width: 90%;
            /* Ensure cards are centered and responsive */
        }
    }

    /* Card Grid Layout for Small Screens */
    @media (max-width: 768px) {
        .content {
            text-align: center;
        }

        .content .card {
            width: 90%;
            margin: 5px auto;
            /* Added more spacing between cards */
        }
    }
</style>


<section>
    <video autoplay muted loop class="video-background" poster="{{ asset('frontend/assets/images/poster-image.jpg') }}"
        preload="auto">
        <source src="{{ asset('frontend/assets/videos/building.mp4') }}" type="video/mp4">
    </video>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 content">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title">Market My Property</h3>
                        <p class="card-text pb-2">
                            {{-- market your property to get potential buyers. --}}
                        </p>
                        <div class="button-box">
                            <a href="{{ route('sell.my.property.details') }}" class="theme-btn btn-one">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 content">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title">Book A Property</h3>
                        <p class="card-text pb-2">
                            {{-- You can book and secure your dream property now. --}}
                        </p>
                        <div class="button-box">
                            <a href="{{ route('book.my.property.details') }}" class="theme-btn btn-one">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-md-4  content">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title">Advertise My Property</h3>
                        <p class="card-text pb-2">
                            {{-- Our platform ensures it reaches potential buyers. --}}
                        </p>
                        <div class="button-box">
                            <a href="{{ route('get.started') }}" class="theme-btn btn-one">Get Started</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
