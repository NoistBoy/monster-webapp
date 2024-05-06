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
            debugger;

            const productId = $(this).data('productid');
            var stock = $('[data-stock-of-' + productId + ']').data('stock-of-' + productId);

            var cartId = $('#cart-id-of-' + productId).val();

            const input = $(this).prev('.quantity-input');
            let currentValue = parseInt(input.val());
            if (input.val() < stock) {

                var sku = $('[data-sku-of-' + productId + ']').data('sku-of-' + productId);
                var upc = $('[data-upc-of-' + productId + ']').data('upc-of-' + productId);
                var costPrice = $('#costPrice-of-' + productId).val();
                var productName = $('#productName-of-' + productId).val();
                var alias = $('[data-alias-of-' + productId + ']').data('alias-of-' + productId);
                var eta = $('[data-eta-of-' + productId + ']').data('eta-of-' + productId);
                var image = $('[data-image-of-' + productId + ']').data('image-of-' + productId);
                var standardPrice = $('#standardPrice-of-' + productId).val();
                var standardPriceWithoutDiscount = $('#standardPriceWithoutDiscount-of-' + productId).val();
                var sequenceNumber = $('#sequenceNumber-of-' + productId).val();
                var minQuantityToSale = $('#minQuantityToSale-of-' + productId).val();
                var maxQuantityToSale = $('#maxQuantityToSale-of-' + productId).val();

                input.val(parseInt(input.val()) + 1)
                addToCart(productId, stock, sku, upc, productName, alias, eta, image, standardPrice,
                    standardPriceWithoutDiscount, sequenceNumber, minQuantityToSale,
                    maxQuantityToSale, 1);
            } else {
                Toast.fire({
                    icon: "info",
                    title: `only ${stock} is availible in stock`
                });
            }
            // currentValue < stock ? input.val(parseInt(input.val()) + 1) : input.val(parseInt(input.val()) + 0);

        });

        $('.quantity-minus').on('click', function(e) {
            e.preventDefault();

            debugger;
            const productId = $(this).data('productid');
            var stock = $('[data-stock-of-' + productId + ']').data('stock-of-' + productId);

            var cartId = $('#cart-id-of-' + productId).val();

            const input = $(this).next('.quantity-input');
            const value = parseInt(input.val()) - 1;
            input.val(value > 0 ? value : 0);

            if (input.val() <= stock) {

                var sku = $('[data-sku-of-' + productId + ']').data('sku-of-' + productId);
                var taxAmount = $('#taxAmount-of-' + productId).val();
                var upc = $('[data-upc-of-' + productId + ']').data('upc-of-' + productId);
                var costPrice = $('#costPrice-of-' + productId).val();
                var productName = $('#productName-of-' + productId).val();
                var alias = $('[data-alias-of-' + productId + ']').data('alias-of-' + productId);
                var eta = $('[data-eta-of-' + productId + ']').data('eta-of-' + productId);
                var image = $('[data-image-of-' + productId + ']').data('image-of-' + productId);
                var standardPrice = $('#standardPrice-of-' + productId).val();
                var standardPriceWithoutDiscount = $('#standardPriceWithoutDiscount-of-' + productId)
                    .val();
                var sequenceNumber = $('#sequenceNumber-of-' + productId).val();
                var minQuantityToSale = $('#minQuantityToSale-of-' + productId).val();
                var maxQuantityToSale = $('#maxQuantityToSale-of-' + productId).val();

                UpdateCart(cartId, productId, stock, sku, upc, productName, alias, eta, image,
                    standardPrice, standardPriceWithoutDiscount, sequenceNumber, minQuantityToSale,
                    maxQuantityToSale, input.val(), costPrice);

            }

        });
    });
</script>
