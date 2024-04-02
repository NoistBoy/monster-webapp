@extends('layout.layout')

@section('content')
    <div class="container-fluid">
        <!-- MainSlider and TopProducts section -->
        @include('layout.MainSlider-TopProducts')

        <!-- Whats new section -->
        @include('layout.WhatsNew')

        <!-- Shop now section -->
        @include('layout.ShopNow')


        <div class="row py-3 mb-5 head-line">
            <marquee behavior="" direction="" class="fw-bold fs-1" scrollamount="18">
                100% Authentic Products <span class="text-danger"> Free Shipping On All Prepaid Orders</span> Best
                Distributor
                For Smoke and Vape
            </marquee>
        </div>

        <!-- Products Spotlight section -->
        @include('layout.ProductsSpotlight')


        <!-- Feauture Brands -->
        @include('layout.FeautureBrands')
    </div>
    <!-- footer -->
    @include('layout.footer')

@endsection


</body>

</html>
