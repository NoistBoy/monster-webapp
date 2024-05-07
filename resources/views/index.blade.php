@extends('layout.layout')

@section('content')
    <div class="container-fluid" >
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
@endsection

@section('custom-scripts')
    <!-- get main sliders -->
    <script>
        $(document).ready(function () {

            const mainSlider = 85;
            getMainSlides(mainSlider)
                .then(sliderImages => {
                // console.log("Slider images:", sliderImages);

                var indicator = ``;
                var carousel_inner = ``;

                sliderImages.forEach((sliderImage, index) => {

                    const imageUrl = sliderImage.imageUrl;
                    const redirectPath = sliderImage.redirectPath;

                    indicator += `<button type="button" data-bs-target="#carousel-main" data-bs-slide-to="${index}" ${ index == 0 ? 'class="active" aria-current="true"' : '' } aria-label="Slide ${index+1 }"></button>`;
                    carousel_inner += `<div class="carousel-item ${ index == 0 ? 'active' : '' }">
                                                <img src=" ${ imageUrl }" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
                                            </div>`;

                });

                $('#carousel-main .carousel-indicators').html(indicator);
                $('#carousel-main .carousel-inner').html(carousel_inner);
            })
            .catch(error => {

                alert("Error fetching slider images:", error);
            });

            // get top five products slides
            const top_5_Products = 94;
            getMainSlides(top_5_Products)
                .then(sliderImages => {
                // console.log("Slider images:", sliderImages);

                var indicator = ``;
                var carousel_inner = ``;

                sliderImages.forEach((sliderImage, index) => {

                    const imageUrl = sliderImage.imageUrl;
                    const redirectPath = sliderImage.redirectPath;

                    indicator += `<button type="button" data-bs-target="#top-five-product-caroucel" data-bs-slide-to="${index}" ${ index == 0 ? 'class="active" aria-current="true"' : '' } aria-label="Slide ${index+1 }"></button>`;
                    carousel_inner += `<div class="carousel-item ${ index == 0 ? 'active' : '' }">
                                                <img src=" ${ imageUrl }" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
                                            </div>`;

                });

                $('#top-five-product-caroucel .carousel-indicators').html(indicator);
                $('#top-five-product-caroucel .carousel-inner').html(carousel_inner);
            })
            .catch(error => {

                alert("Error fetching slider images:", error);
            });


            // get spot light products slides
            const spotLight_Products = 98;
            getMainSlides(spotLight_Products)
                .then(sliderImages => {
                // console.log("Slider images:", sliderImages);

                var indicator = ``;
                var carousel_inner = ``;

                sliderImages.forEach((sliderImage, index) => {

                    const imageUrl = sliderImage.imageUrl;
                    const redirectPath = sliderImage.redirectPath;

                    indicator += `<button type="button" data-bs-target="#carousel-second" data-bs-slide-to="${index}" ${ index == 0 ? 'class="active" aria-current="true"' : '' } aria-label="Slide ${index+1 }"></button>`;
                    carousel_inner += `<div class="carousel-item ${ index == 0 ? 'active' : '' }">
                                                <img src=" ${ imageUrl }" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
                                            </div>`;

                });

                $('#carousel-second .carousel-indicators').html(indicator);
                $('#carousel-second .carousel-inner').html(carousel_inner);
            })
            .catch(error => {

                alert("Error fetching slider images:", error);
            });


        }); // end of jQ doc ready


        async function getMainSlides(sliderTypeId) {
            const url = `https://erp.monstersmokewholesale.com/api/home/sliderImages?sliderTypeId=${sliderTypeId}&businessTypeId=1`;

            try {
                const response = await fetch(url, {
                    method: 'GET'
                });

                const data = await response.json();

                if (!data.hasError) {
                    return data.result.sliderImageList;
                } else {
                    throw new Error("Something went wrong!");
                }
            } catch (error) {
                console.error("Error fetching slider images:", error);
                throw error;
            }
        }

    </script>
    <!-- get main sliders End -->

    <!-- get shopNow section -->
    <script>
     document.addEventListener("DOMContentLoaded", function() {

        getFeaturedProductsByEachTag(2)
                    .then(products => {
                        var cardItem = "";
                        var productSection = "";
                        if(!products.hasError){

                            products.result.content.forEach((products) => {
                                cardItem += getSingleProductCardItem(products);
                            });

                            if (isNotEmpty(cardItem)) {
                                    productSection += `<div class=" container-fluid">
                                                        <div class="p-3 mt-5 product-section-wrapper" style="border-radius: 21px;">
                                                            <h2 class="section-heading fw-bold fs-1 mt-2 mb-3 px-3">Whats New</h2>
                                                            <!-- owl-carousel start -->
                                                            <div class="owl-carousel owl-theme ">`;

                                    productSection += cardItem;

                                    productSection += ` </div>
                                                        </div>
                                                        <!-- owl-carousel END -->
                                                    </div>`;
                            }
                            $('#whats-new-products-section').append(productSection);
                        }

                    })
                    .catch(error => {
                        alert("Error - - fetching featured products:", error);
                    });

            // ===================================================
            getFeaturedProductsTags()
                .then(tags => {

                tags.result.forEach((tag) => {
                    const tagId = tag.id;
                    const tagName = tag.name;

                    getFeaturedProductsByEachTag(tagId)
                    .then(products => {
                        var cardItem = "";
                        var productSection = "";
                        if(!products.hasError){

                            products.result.content.forEach((products) => {
                                cardItem += getSingleProductCardItem(products);
                            });

                            if (isNotEmpty(cardItem)) {
                                    productSection += `<div class="container-fluid mb-5">
                                                        <div class="p-3  product-section-wrapper" style="border-radius: 21px;">
                                                            <h2 class="section-heading fw-bold fs-1 mt-2 mb-3 px-3">${tagName}</h2>
                                                            <!-- owl-carousel start -->
                                                            <div class="owl-carousel owl-theme ">`;

                                    productSection += cardItem;

                                    productSection += ` </div>
                                                        </div>
                                                        <!-- owl-carousel END -->
                                                    </div>`;
                                                }
                            $('#tags-products-section').append(productSection);
                        }

                    })
                    .catch(error => {
                        alert("Error fetching featured products:", error);
                    });

                });

            })
            .catch(error => {

                alert("Error fetching product tags:", error);
            });

        }); // jQdocReady close

        async function getFeaturedProductsTags() {
            const url = 'https://erp.monstersmokewholesale.com/api/home/productTagList';

            try {
                const response = await fetch(url, {
                    method: 'GET'
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                return await response.json();
            } catch (error) {
                console.error('Error fetching product tags:', error);
                throw error;
            }
        }

        //
        async function getFeaturedProductsByEachTag(tagId) {
            const url = `https://erp.monstersmokewholesale.com/api/home/product/tagId/${tagId}?page=0&size=10&businessTypeId=1&storeId=2`;

            try {
                const response = await fetch(url, {
                    method: 'GET'
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                return await response.json();

            } catch (error) {
                alert('Error fetching featured products by tag:', error);
                throw error;
            }
        }
      // Function to check if the user is logged in
        function isUserLogin() {

            var accessToken = '{{ Session::get("user.accessToken") }}';

            return accessToken && accessToken !== '';
        }

        // Function to generate HTML for a single product card item
        function getSingleProductCardItem(product) {
            // Get product details
            const productImage = product.imageUrl;
            const productPrice = isUserLogin() ? `$ ${product.standardPrice.toFixed(2)}` : '$xx.xx';
            const productNameEncoded = encodeURIComponent(product.productName.replace(/\//g, '-').replace(/--/g, '-').replace(/ /g, '-').replace(/\|/g, ''));
            const href = isUserLogin() ? `/product-details/${productNameEncoded}?product_id=${product.productId}` : '/sign-in';

            // Construct HTML for the product card item
            const productCardItemHTML = `
                <div class="item">
                    <div class="product-card" data-href="/product-details/${productNameEncoded}?product_id=${product.productId}">
                        <div class="d-flex justify-content-end align-items-center mb-3">
                            <span class="d-block new-arrival"><i class="lni lni-star-fill"></i> New Arrival</span>
                        </div>
                        <div class="d-flex justify-content-center same-height-images after-overlay">
                            <img src="${productImage}" alt="image" srcset="" class="img-fluid w-75 pro-img">
                            <div class="button-container">
                                <a href="/product-details/${productNameEncoded}?product_id=${product.productId}" class="see-all-options">See all Options</a>
                            </div>
                        </div>
                        <div>
                            <a href="/product-details/${productNameEncoded}?product_id=${product.productId}" class="fs-6 text product-card-title fw-bold">${product.productName}</a>
                            <div class="d-flex justify-content-between mb-2" style="align-items: center;">
                                <a href="${href}" class="fs-5 text product-card-title product-card-price fw-bold ${(isUserLogin() ? '' : 'protected')}" style="margin-bottom: 0 !important;">${productPrice}</a>
                                <span class="d-block fw-bold product-card-stock-detail ${product.availableQuantity <= 0 ? 'text-danger' : 'text-secondary'}">${product.availableQuantity <= 0 ? '(Out of Stock)' : 'In Stock: ' + product.availableQuantity}</span>
                            </div>
                            <a class="btn product-card-btn fw-bold" href="${href}">${isUserLogin() ? (product.availableQuantity <= 0 ? 'Out of Stock' : 'Buy Now') : 'Login to view price'}</a>
                        </div>
                    </div>
                </div>`;

            return productCardItemHTML;
        }

        function isNotEmpty(variable) {
            return variable !== null && variable !== undefined && variable !== '';
        }
    </script>
    <!-- get shopNow section End -->
@endsection

</body>

</html>
