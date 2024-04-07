@extends('layout.layout')




@section('custom-style')
<style>
    .owl-prev {
        left: -13px !important;
    }
    .owl-next {
        right: -17px !important;
    }
    .same-height-images img {
        height: 250px;
        width: auto;
        margin: 5px;
    }
</style>
@endsection

@section('content')
    <div class="container-fluid" style="margin-top: 90px;">
        <div class="row">
            <div class="col-12">
                <nav class="mt-4 px-5 mb-2" aria-label="breadcrumb" style="padding-left: 2.5rem !important;">
                    <ol class="breadcrumbs">
                        <li><a href="{{ url('/') }}">HOME</a></li>
                        <li id="product-title-secondary" ></li>
                    </ol>
                </nav>
            </div>
        </div>
        <form action="" id="order-products-form" >
            <div class="row mb-3">
                {!! $SingleProductDetailSection !!}
            </div>
        </form>
        <!-- Related Products Section -->
        <div class="row px-4 mb-5">
            <div class="col-12">
                {{-- <div class="container-fluid mb-5"> --}}
                    <h2 class=" fw-bold fs-1 my-4">Related Products</h2>
                    <!-- owl-carousel start -->
                    <div class="owl-carousel owl-theme ">
                        {!! $whatsNew_section !!}
                    </div>
                    <!-- owl-carousel END -->
                {{-- </div> --}}
            </div>
        </div>

    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {
            $('.quantity-input').on('change', function() {
                const value = parseInt($(this).val());
                if (isNaN(value) || value <= 0) {
                    $(this).val(0);
                }
            });

            $('.quantity-plus').on('click', function(e) {
                e.preventDefault();
                const productId = $(this).data('productid');
                var stock = $('[data-stock-of-'+productId+']').data('stock-of-'+productId);

                const input = $(this).prev('.quantity-input');
                let currentValue = parseInt(input.val());

                currentValue < stock ? input.val(parseInt(input.val()) + 1) : input.val(parseInt(input.val()) + 0);
            });

            $('.quantity-minus').on('click', function(e) {
                e.preventDefault();
                const input = $(this).next('.quantity-input');
                const value = parseInt(input.val()) - 1;
                input.val(value > 0 ? value : 0);
            });

            $('#product-title-secondary').text($('#product-title').text());
        });

    </script>
@endsection
