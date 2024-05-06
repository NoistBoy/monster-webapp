
const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    }
});


$(document).ready(function () {



    $('.pro-img').click(function (e) {
        e.preventDefault();
        var href = $(this).closest('.product-card').data('href');
        window.location.href = href;
    });

    // $('.subCategory-item-option').click(function (e) {
    //     e.preventDefault();
    //     var href = $(this).data('href');
    //     window.location.href = href;
    // });

    $('.dropdown').hover(function () {
        $(this).addClass('show');
        $(this).find('.dropdown-menu').addClass('show');
    }, function () {
        $(this).removeClass('show');
        $(this).find('.dropdown-menu').removeClass('show');
    });


    $('.sidebar li').click(function () {

        var id = $(this).attr('id');
        var category_list = $(this).closest('#category-list');
        category_list.hide();
        var list_values_to_show = $('#' + id + '-list');
        list_values_to_show.fadeIn();

        list_values_to_show.on('click', '.back-to-category', function () {
            category_list.fadeIn();
            list_values_to_show.hide();

        });

    });
    $('.top-5-products').click(function (e) {
        e.preventDefault();
        console.log("test");
    });

    $('#apply-for-account').click(function (e) {
        e.preventDefault();
        let formData = new FormData($('#singUp-form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/post-sing-up',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                console.log(response);
                Swal.fire({
                    title: response.status,
                    text: response.message,
                    icon: response.status,
                    customClass: {
                        confirmButton: 'custom-sweetAlert-btn-confirm',
                        cancelButton: 'btn btn-secondary'
                    }
                });
                if (response.status == "success") {
                    resetForm();
                }
            },
            error: function (xhr, status, error) {

                if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $('.error-message').text('');

                    $.each(errors, function (field, fieldErrors) {
                        $('#' + field + '_error').text(fieldErrors[0]);
                    });
                } else {

                    console.log("The status " + status);
                    console.log("The Message " + error);
                }
            }

        });

    });
    $('#singin-account').click(function (e) {
        e.preventDefault();

        let formData = new FormData($('#singIn-form')[0]);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'POST',
            url: '/post-sing-in',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == "success") {
                    resetForm();
                    window.location.href = response.redirect;
                } else {
                    Swal.fire({
                        title: response.status,
                        text: response.message,
                        icon: response.status,
                        customClass: {
                            confirmButton: 'custom-sweetAlert-btn-confirm',
                            cancelButton: 'btn btn-secondary'
                        }
                    });
                }
            },
            error: function (xhr, status, error) {

                if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $('.error-message').text('');

                    $.each(errors, function (field, fieldErrors) {
                        $('#' + field + '_error').text(fieldErrors[0]);
                    });
                } else {

                    console.log("The status " + status);
                    console.log("The Message " + error);
                }
            }

        });

    });
    // get states  by country id
    $('#country_id, .country_id_class').change(function (e) {
        e.preventDefault();
        var stateInput;


        if ($(this).hasClass('country_id_class')) {
            stateInput = $(".state_id_class");
        } else {
            stateInput = $("#state_id");
        }

        stateInput.prop('disabled', true);
        var countryId = $(this).val();
        // console.log("The values  " + countryId);
        if (countryId !== null && countryId !== "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/get-states',
                data: {
                    countryId: countryId
                },
                success: function (response) {
                    stateInput.html(response);
                    stateInput.prop('disabled', false);
                },
                error: function (xhr, status, error) {
                    console.log("The status " + status);
                    console.log("The Message " + error);
                }
            });

        } else {
            stateInput.html("<option>---- Please  Select Country First ----</option>");
            stateInput.prop('disabled', true);
        }

    });
    getCartCount();


    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if (scroll > 0) {
            $('.custom-navbar').addClass('sticky-top');
            $('.sidebar').css('margin-top', '-30px');
            $('.sidebar-footer').css('bottom', '4%');

            // $('.sidebar').addClass('sticky-top');

        } else {
            $('.custom-navbar').removeClass('sticky-top');
            $('.sidebar').css('margin-top', '30px');
            $('.sidebar-footer').css('bottom', '10%');
            // $('.sidebar').removeClass('sticky-top');

        }
    });

    $('.add-item-to-cart').click(function (e) {
        e.preventDefault();

        let formData = new FormData($('#order-products-form')[0]);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/post-multiple-cart-item',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {

                    Toast.fire({
                        icon: `${response.icon}`,
                        title: `${response.message}`
                    });
                    getCartCount();

                    $('.quantity-input').val(parseInt(0));
                },
                error: function (xhr, status, error) {
                        console.log("The status " + status);
                        console.log("The Message " + error);

                }
            });
    });


    $('#search-product-input').keydown(function (e) {

        // e.preventDefault();
        // $('#search-result').show();
        // $('#search-result').html(`<div class="row">
        //                                 <div class="col-12 text-center">
        //                                     <p> Loading... </p>
        //                                 </div>
        //                             </div>`);
        if($(this).val().length > 2) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'GET',
                url: '/search-product',
                async: false,
                data: {
                    searchQuery : $(this).val(),
                },
                success: function (response) {
                    console.log( "The response " + response);
                    var tr = ``;
                    if(response && response.status == "success"){
                        if (response.products) {

                            tr += `<div class="row  px-4 pt-3">
                                        <div class="col-9 fw-bold">
                                            <h5 class="fw-bold" > Products </h5>
                                        </div>
                                    </div>`;
                            response.products.forEach(element => {
                                var prdName = element.productName.replace(/\|/g, '')
                                .replace(/ /g, '-')
                                .replace(/--/g, '-')
                                .replace(/\//g, '-');
                                var url = '/product-details/'+encodeURIComponent(prdName)+'?product_id='+element.productId;

                                var img = element.imageUrl == "null" ? "/asset/img/place-holder.png" : element.imageUrl;

                                tr += `<div class="row  px-4 pt-3"><a href="${url}" class="d-flex justify-content-center align-items-center mb-3" >
                                            <div class="col-3">
                                               <img src="${img}" class="img-fluid w-75 shadow rounded" alt="image">
                                            </div>
                                            <div class="col-9 fw-bold">
                                                <p> ${element.productName} </p>
                                            </div></a>
                                        </div>`;
                            });

                            if(response.category){
                                tr += `<div class="row d-flex justify-content-center align-items-center py-3 mt-3 search-result-footer" style="background:#3c3b6e;">
                                        <a href="/each-category-products/search/${response.category.alias}/${response.category.id}" class="d-flex justify-content-center align-items-center" >
                                            <div class="col-12 text-center" style=" color:#FFFFFF !important;">
                                                See All (${response.totalCount}) Resultes
                                            </div>
                                        </a>
                                    </div>`;
                            }
                        }
                        else{
                            tr += `<div class="row">
                                        <div class="col-12 text-center">
                                            <p>No product match with your search</p>
                                        </div>
                                    </div>`;
                        }
                    }else{
                        tr = `<div class="row">
                                <div class="col-12 text-center">
                                    <p>No product match with your search</p>
                                </div>
                            </div>`;
                    }

                    $('#search-result').html(tr);
                    $('#search-result').show();
                    // console.log("The tr" + tr);
                },
                error: function (xhr, status, error) {
                        console.log("The status " + status);
                        console.log("The Message " + error);

                }
            });
        }
    });

    $('#search-product-input').blur(function(){
        if($(this).val().length > 2){
            return;
        }
        $('#search-result').css('display', 'none');
    });

    $('#search-product-input').focus(function(){
        $('#search-result').css('display', 'block');
    });

});


function toggleSidebar() {
    var sidebar = document.querySelector('.sidebar');
    sidebar.classList.toggle('active');
}
function resetForm() {
    $('.error-message').text('');
    $('.reset').val(null);
}

function addToCart(productId, stock, sku, upc, productName, alias, eta, image, standardPrice, standardPriceWithoutDiscount, sequenceNumber, minQuantityToSale, maxQuantityToSale, quantity) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: '/post-cart',
        data: {
            productId,
            stock,
            sku,
            upc,
            productName,
            alias,
            eta,
            image,
            standardPrice,
            standardPriceWithoutDiscount,
            sequenceNumber,
            minQuantityToSale,
            maxQuantityToSale,
            quantity
        },
        async: false,
        success: function (response) {

            if(response.status == "success"){
                if ($('.quantity-plus').hasClass('showSuccessMessage')) {
                    Toast.fire({
                        icon: `${response.icon}`,
                        title: `${response.message}`
                    });
                }

                getCartCount();
            }else{
                Toast.fire({
                    icon: `${response.icon}`,
                    title: `${response.message}`
                });
            }
        },
        error: function (xhr, status, error) {

            Toast.fire({
                icon: 'error',
                title: 'Something went wrong!'
            });
        }

    });
}
function UpdateCart(cartId,productId, stock, sku, upc, productName, alias, eta, image, standardPrice, standardPriceWithoutDiscount, sequenceNumber, minQuantityToSale, maxQuantityToSale, quantity, costPrice) {

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        url: '/update-cart-item',
        data: {
            cartId,
            productId,
            stock,
            sku,
            upc,
            productName,
            alias,
            eta,
            image,
            standardPrice,
            standardPriceWithoutDiscount,
            sequenceNumber,
            minQuantityToSale,
            maxQuantityToSale,
            quantity,
            costPrice
        },

        success: function (response) {

            if(response.status == "error"){
                Toast.fire({
                    icon:`${response.icon}`,
                    title: `${response.message}`
                });
            }else{
                getCartCount();

            }

        },
        error: function (xhr, status, error) {
            getCartCount();
            // Toast.fire({
            //     icon: "error",
            //     title: `Something went wrong!`
            // });

        }

    });
}

function getCartCount() {
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'GET',
        url: '/get-cart-item',
        success: function (response) {
            if (!response.hasError) {
                $('.cart-count').text(response.result.totalCartQuantity);
                $('.cart-count-main').text(response.result.totalCartQuantity);

                if($('.totalCartQuantity')){
                    $('.totalCartQuantity').text(response.result.totalCartQuantity);
                }
                if($('.cartDiscount')){
                    $('.cartDiscount').text(response.result.cartDiscount+"%");
                }
                if($('.cartSubTotal')){
                    $('.cartSubTotal').text("$"+response.result.cartSubTotal);
                }
                if($('.totalCartPrice')){
                    $('.totalCartPrice').text("$"+response.result.totalCartPrice);
                }
                if($('.total-cart-price-checkout')){
                    $('.total-cart-price-checkout').text("$"+response.result.totalCartPrice);
                }
            }

        },
        error: function (xhr, status, error) {
            console.log("The status " + status);
            console.log("The Message " + error);
        }
    });
}

function deleteCartItem(CartID,productID) {
    // console.log("The cart idd " + CartID);
    // console.log("The product Idd" + productID);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "post",
        url: "/delete-cart-item",
        data: {
            productID : productID,
            CartID : CartID,
            storeId : $('#storeId-of-'+productID).val(),
            productName : $('#productName-of-'+productID).val(),
            sku : $('#sku-of-'+productID).val(),
            upc : $('#upc-of-'+productID).val(),
            quantity : $('#quantity-of-'+productID).val(),
            status : $('#status-of-'+productID).val(),
            costPrice : $('#costPrice-of-'+productID).val(),
            standardPrice : $('#standardPrice-of-'+productID).val(),
            cartStandardPrice : $('#cartStandardPrice-of-'+productID).val(),
            tierPrice : $('#tierPrice-of-'+productID).val(),
            originalStandardPrice : $('#originalStandardPrice-of-'+productID).val(),
            adminRetailPrice : $('#adminRetailPrice-of-'+productID).val(),
            availableQuantity : $('#availableQuantity-of-'+productID).val(),
            deleted : $('#deleted-of-'+productID).val(),
            discountValue : $('#discountValue-of-'+productID).val(),
            discountType : $('#discountType-of-'+productID).val(),
            discountAmount : $('#discountAmount-of-'+productID).val(),
            cartStandardPrice : $('#cartStandardPrice-of-'+productID).val(),
            taxClassId : $('#taxClassId-of-'+productID).val(),
            taxType : $('#taxType-of-'+productID).val(),
            taxPercentage : $('#taxPercentage-of-'+productID).val(),
            taxPerVolume : $('#taxPerVolume-of-'+productID).val(),
            outOfStock : $('#outOfStock-of-'+productID).val(),
            minQuantityToSale : $('#minQuantityToSale-of-'+productID).val(),
            maxQuantityToSale : $('#maxQuantityToSale-of-'+productID).val(),
            quantityIncrement : $('#quantityIncrement-of-'+productID).val(),
            cartLineItemUpdated : $('#cartLineItemUpdated-of-'+productID).val(),
            imageUrl : $('#imageUrl-of-'+productID).val(),
            updatedBy : $('#updatedBy-of-'+productID).val(),
            insertedTimestamp : $('#insertedTimestamp-of-'+productID).val(),
            updatedTimestamp : $('#updatedTimestamp-of-'+productID).val(),
            discount : $('#discount-of-'+productID).val(),
            taxIncludedInSellingPrice : $('#taxIncludedInSellingPrice-of-'+productID).val(),
            taxPerOunce : $('#taxPerOunce-of-'+productID).val(),
            directTaxPercentage : $('#directTaxPercentage-of-'+productID).val(),
            maxCostPrice : $('#maxCostPrice-of-'+productID).val(),
            taxAmount : $('#taxAmount-of-'+productID).val(),
            size : $('#size-of-'+productID).val(),
            serviceProduct : $('#serviceProduct-of-'+productID).val(),
        },
        success: function (response) {
            Toast.fire({
                icon: "success",
                title: `SomethingItem successfully removed from the cart.`
            });
            $('#cartItem-row-of-'+productID).fadeOut();
            getCartCount();
        },
        error: function (xhr, status, error) {

            Toast.fire({
                icon: "error",
                title: `Something went wrong!`
            });
        }
    });
}

function showLoadingScreen() {
    $('#loading-screen').show();
}


function hideLoadingScreen() {
    $('#loading-screen').hide();
  }
