<div class="row">
    <div class="col-md-12 col-sm-12 px-0 py-5">
        <div>
            <img src="{{ asset('asset/img/Asset 1-8.png') }}" alt="image" srcset="" class="w-100 img-fluid">
        </div>

        {!! $ShopNowSection !!}
        <!-- Featured And Disposable Section -->
        {{-- @if (!empty($FeaturedAndDisposable_section))
            <div class="container">
                <h2 class=" fw-bold fs-1 my-4">Featured And Disposable</h2>
                <!-- owl-carousel start -->
                <div class="owl-carousel owl-theme ">
                    {!! $FeaturedAndDisposable_section !!}
                </div>
                <!-- owl-carousel END -->
            </div>
        @endif --}}
        <!-- Featured And Disposable Section END -->

        <!-- Featured Products Section -->
        {{-- @if (!empty($FeaturedProducts_section))
            <div class="container">
                <h2 class=" fw-bold fs-1 my-4">Featured Products</h2>
                <!-- owl-carousel start -->
                <div class="owl-carousel owl-theme ">
                    {!! $FeaturedProducts_section !!}
                </div>
                <!-- owl-carousel END -->
            </div>
        @endif --}}
        <!-- Featured Products Section END -->

        <!-- Best Sellers Section -->
        {{-- @if (!empty($BestSellers_section))
            <div class="container">
                <h2 class=" fw-bold fs-1 my-4">Best Sellers</h2>
                <!-- owl-carousel start -->
                <div class="owl-carousel owl-theme ">
                    {!! $BestSellers_section !!}
                </div>
                <!-- owl-carousel END -->
            </div>
        @endif --}}
        <!-- Best Sellers Section END -->

        <!-- Limited Time Offer Section -->
        {{-- @if (!empty($Timelimited_section))
            <div class="container">
                <h2 class=" fw-bold fs-1 my-4">Limited Time Offer</h2>

                <!-- owl-carousel start -->
                <div class="owl-carousel owl-theme ">
                    {!! $Timelimited_section !!}
                </div>
                <!-- owl-carousel END -->
            </div>
        @endif --}}
        <!-- Limited Time Offer Section END -->
    </div>
</div>
