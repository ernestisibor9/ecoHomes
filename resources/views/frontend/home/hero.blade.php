<style>
    .content {
        position: relative;
        z-index: 1;
        color: white;
        text-align: center;
        padding: 30px;
        transform: translateY(-50%);
        font-family: Arial, sans-serif;
        margin-top: -300px;
        background: linear-gradient(rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8));
    }

    .content h1 {
        color: #ffffff;
        font-size: 3rem;
        font-weight: bold;
    }
</style>

<section class="">
    <video autoplay muted loop class="video-background banner-style-three"
        poster="{{ asset('frontend/assets/images/poster-image.jpg') }}" preload="auto">
        <source src="{{ asset('frontend/assets/videos/building.mp4') }}" type="video/mp4">
    </video>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="content">
                    <h1>Do You Have A </h1> <br>
                    <h1>Property To Sell?</h1> <br>
                    {{-- <p class="text-white">EcoHomes is a one-stop platform to rent, sell and advertise properties</p> --}}
                    <div class="button-box">
                        <a href="{{route('get.started')}}" class="theme-btn btn-one">Get Started</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>
