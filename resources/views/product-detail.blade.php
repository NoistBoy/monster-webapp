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

    .same-height-images .pro-img {
        /* height: 200px; */
        height: 190px !important;
        width: auto;
        margin: 5px;
        object-fit: contain;
    }
</style>
@endsection

@section('content')
    <div class="container-fluid py-5">
        <div class="row mb-2 px-3">
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
        <div class="row px-3 mb-2">
            <div class="col-12">
                {{-- <div class="container-fluid mb-5"> --}}
                    <!-- owl-carousel start -->
                    <div class="p-3  product-section-wrapper" style="border-radius: 21px;">
                        <h2 class=" fw-bold fs-1 my-4 px-3 section-heading" >Related Products</h2>
                        <div class="owl-carousel owl-theme ">
                            {!! $whatsNew_section !!}
                        </div>
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

            $('#product-title-secondary').text($('#product-title').text());

            $('.quantity-input').on('change', function() {
                const value = parseInt($(this).val());
                if (isNaN(value) || value <= 0) {
                    $(this).val(0);
                }
            });

            // $('.add-item-to-cart').on('click', function(e) {
            $('.quantity-plus').on('click', function(e) {
                e.preventDefault();
                debugger;
                const productId = $(this).data('productid');
                var stock = $('[data-stock-of-'+productId+']').data('stock-of-'+productId);
                const input = $(this).prev('.quantity-input');
                let currentValue = parseInt(input.val());
                if(currentValue < stock){
                    input.val(parseInt(input.val()) + 1);
                    // $('#postQuantity-of-'+productId).val(input.val());
                }else{
                    input.val(parseInt(input.val()) + 0);
                }

            });

            $('.quantity-minus').on('click', function(e) {
                e.preventDefault();

                const productId = $(this).data('productid');
                var stock = $('[data-stock-of-' + productId + ']').data('stock-of-' + productId);

                var cartId = $('#cart-id-of-' + productId).val();

                const input = $(this).next('.quantity-input');
                const value = parseInt(input.val()) - 1;
                input.val(value > 0 ? value : 0);
                // $('#postQuantity-of-'+productId).val(input.val(value > 0 ? value : 0));
            });

            // $('.quantity-plus').on('click', function(e) {
            //     e.preventDefault();
            //     debugger;

            //     const productId = $(this).data('productid');
            //     var cartId = $('#cart-id-of-'+productId).val();
            //     var stock = $('[data-stock-of-'+productId+']').data('stock-of-'+productId);
            //     var sku = $('[data-sku-of-'+productId+']').data('sku-of-'+productId);
            //     var upc = $('[data-upc-of-'+productId+']').data('upc-of-'+productId);
            //     var productName = $('#productName-of-'+productId).val();
            //     var alias = $('[data-alias-of-'+productId+']').data('alias-of-'+productId);
            //     var eta = $('[data-eta-of-'+productId+']').data('eta-of-'+productId);
            //     var image = $('[data-image-of-'+productId+']').data('image-of-'+productId);
            //     var standardPrice = $('#standardPrice-of-'+productId).val();
            //     var standardPriceWithoutDiscount = $('#standardPriceWithoutDiscount-of-'+productId).val();
            //     var sequenceNumber = $('#sequenceNumber-of-'+productId).val();
            //     var minQuantityToSale = $('#minQuantityToSale-of-'+productId).val();
            //     var maxQuantityToSale = $('#maxQuantityToSale-of-'+productId).val();

            //        const input = $(this).prev('.quantity-input');
            //        let currentValue = parseInt(input.val());

            //     if(stock > 0){

            //             addToCart(productId,stock,sku,upc,productName,alias,eta,image,standardPrice,standardPriceWithoutDiscount,sequenceNumber,minQuantityToSale,maxQuantityToSale,1);

            //     }else{
            //         Toast.fire({
            //             icon: "info",
            //             title: `please note that it is currently out of stock.`
            //         });
            //     }
            //     currentValue < stock ? input.val(parseInt(input.val()) + 1) : input.val(parseInt(input.val()) + 0);

            // });

            // $('.quantity-minus').on('click', function(e) {
            //     e.preventDefault();
            //     debugger;
            //     const productId = $(this).data('productid');
            //     var stock = $('[data-stock-of-' + productId + ']').data('stock-of-' + productId);

            //     var cartId = $('#cart-id-of-' + productId).val();

            //     const input = $(this).next('.quantity-input');
            //     const value = parseInt(input.val()) - 1;
            //     input.val(value > 0 ? value : 0);

            //     if (input.val() <= stock) {

            //         var sku = $('[data-sku-of-' + productId + ']').data('sku-of-' + productId);
            //         var taxAmount = $('#taxAmount-of-' + productId).val();
            //         var upc = $('[data-upc-of-' + productId + ']').data('upc-of-' + productId);
            //         var costPrice = $('#costPrice-of-' + productId).val();
            //         var productName = $('#productName-of-' + productId).val();
            //         var alias = $('[data-alias-of-' + productId + ']').data('alias-of-' + productId);
            //         var eta = $('[data-eta-of-' + productId + ']').data('eta-of-' + productId);
            //         var image = $('[data-image-of-' + productId + ']').data('image-of-' + productId);
            //         var standardPrice = $('#standardPrice-of-' + productId).val();
            //         var standardPriceWithoutDiscount = $('#standardPriceWithoutDiscount-of-' + productId).val();
            //         var sequenceNumber = $('#sequenceNumber-of-' + productId).val();
            //         var minQuantityToSale = $('#minQuantityToSale-of-' + productId).val();
            //         var maxQuantityToSale = $('#maxQuantityToSale-of-' + productId).val();

            //         UpdateCart(cartId, productId, stock, sku, upc, productName, alias, eta, image,
            //             standardPrice, standardPriceWithoutDiscount, sequenceNumber, minQuantityToSale,
            //             maxQuantityToSale, input.val(), costPrice);

            //     }

            // });

        });

    </script>
@endsection
