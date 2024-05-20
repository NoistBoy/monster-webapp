@extends('layout.layout')
<!--  Get Categories Products  -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        fetchProductsByPage(0);

        $('#product-sort-filter').change(function (e) {
            e.preventDefault();
            fetchProductsByPage(0, $(this).val()); // Removed the semicolon from here
        });
    });

    function fetchProductsByPage(page,sortType=0) {
        $('.loading-products').show();
        $('.product-grid').html("");
        switch (sortType) {
            case '0':
                sort = "date";
                sortDirection = "DESC";

                break;
            case '1':
                sort = "date";
                sortDirection = "ASC";

                break;
            case '2':
                sort = "name";
                sortDirection = "ASC";

                break;
            case '3':
                sort = "name";
                sortDirection = "DESC";

                break;
            case '4':
                sort = "price";
                sortDirection = "ASC";

                break;
            case '5':
                sort = "price";
                sortDirection = "DESC";

                break;

            default:
                sort = "date";
                sortDirection = "DESC";
        }

        const categoryId = {{ $categoryId }};
        const url = `https://erp.monstersmokewholesale.com/api/ecommerce/product/category?categoryIdList=${categoryId}&page=${page}&size=20&sort=${sort}&sortDirection=${sortDirection}&storeIds=2`;

        getProducts(url)
            .then(products => {
                var Pagination = ``;

                const productsHTML = getEachCategoryProductsSections(products);
                $('.product-grid').html(productsHTML);
                $('.loading-products').css('display', 'none');
                if (products.status === 200 && products.result.content.length > 0) {
                    const totalPages = products.result.totalPages;
                    const currentPage = parseInt(products.result.number) + 1;

                    // Calculate the range of pages to display
                    let startPage = Math.max(1, currentPage - 4); // Show 4 pages before the current page
                    let endPage = Math.min(startPage + 9, totalPages); // Show up to 10 pages, or less if close to the end

                    let Pagination = `<ul class="pagination">`;

                    // Previous page link
                    Pagination += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                        <a class="page-link" href="javascript:fetchProductsByPage(${currentPage === 1 ? 0 : currentPage - 2})">Previous</a>
                                    </li>`;

                    // Generate page links within the range
                    for (let i = startPage; i <= endPage; i++) {
                        const active = currentPage === i ? 'active' : '';
                        Pagination += `<li class="page-item ${active}">
                                            <a class="page-link" href="javascript:fetchProductsByPage(${i - 1})">${i}</a>
                                        </li>`;
                    }

                    // Next page link
                    Pagination += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                        <a class="page-link" href="javascript:fetchProductsByPage(${currentPage === totalPages ? totalPages - 1 : currentPage})">Next</a>
                                    </li>
                                </ul>`;

                    // Append the pagination HTML to the desired container
                    $('.product-pagination').html(Pagination);

                    $('.loading-products').hide();
                }
            })
            .catch(error => {
                alert('Error fetching products:', error);
                $('.loading-products').hide();
            });


    }


    async function getProducts(url = 'https://erp.monstersmokewholesale.com/api/ecommerce/product/category?categoryIdList='+{{ $categoryId }}+'&page=0&size=20&sort=date&sortDirection=DESC&storeIds=2') {

        try {
            const response = await fetch(url, {
                method: 'GET'
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return await response.json();
        } catch (error) {
            console.error('Error fetching products:', error);
            throw error;
        }
    }
    // Function to check if the user is logged in
    function isUserLogin() {
        var accessToken = '{{ Session::get("user.accessToken") }}';

        return accessToken && accessToken !== '';
    }
    function imgUrl(url) {
        if (url && url !== "" && url !== "null") {
            return url;
        } else {
            return "/asset/img/place-holder.png";
        }
    }

    function getEachCategoryProductsSections(response) {
        let productsHTML = "";
        if (response && response.status === 200 && response.result && response.result.content.length > 0) {
            response.result.content.forEach(newProduct => {
                const productImage = imgUrl(newProduct.imageUrl);
                const productPrice = isUserLogin() ? `$ ${newProduct.standardPrice.toFixed(2)}` : '$xx.xx';
                const productNameEncoded = encodeURIComponent(newProduct.productName.replace(/\//g, '-').replace(/--/g, '-').replace(/ /g, '-').replace(/\|/g, ''));
                const href = isUserLogin() ? `/product-details/${productNameEncoded}?product_id=${newProduct.productId}` : '/sign-in';

                productsHTML += `
                    <div class="product-card product-card-each-category" data-href="/product-details/${productNameEncoded}?product_id=${newProduct.productId}">
                        <div class="d-flex justify-content-center align-items-center mb-3">
                            <span class="d-block new-arrival new-arrival-each-category"><i class="lni lni-star-fill"></i> New Arrival</span>
                        </div>
                        <div class="d-flex justify-content-center same-height-images after-overlay">
                            <img src="${productImage}" alt="image" class="img-fluid w-75 pro-img">
                            <div class="button-container">
                                <a href="/product-details/${productNameEncoded}?product_id=${newProduct.productId}" class="see-all-options">See&nbsp;all&nbsp;Options</a>
                            </div>
                        </div>
                        <div>
                            <a href="/product-details/${productNameEncoded}?product_id=${newProduct.productId}" class="fs-6 text product-card-title fw-bold">${newProduct.productName}</a>
                            <div class="d-flex justify-content-between mb-2" style="align-items: center;">
                                <a href="${href}" class="fs-5 text product-card-title product-card-price fw-bold ${(isUserLogin() ? '' : 'protected')}" style="margin-bottom: 0 !important;">${productPrice}</a>
                                <span class="d-block fw-bold product-card-stock-detail ${newProduct.availableQuantity <= 0 ? 'text-danger' : 'text-secondary'}">${newProduct.availableQuantity <= 0 ? '(Out of Stock)' : 'In Stock: ' + newProduct.availableQuantity}</span>
                            </div>
                            <a href="${href}" class="btn product-card-btn fw-bold">${isUserLogin() ? (newProduct.availableQuantity <= 0 ? 'Out of Stock' : 'Buy Now') : 'Login to View Price'}</a>
                        </div>
                    </div>`;
            });
        }else{
            productsHTML = `<div class="conteiner p-3 fw-bold fs-3 w-100" >No&nbsp;products&nbsp;found!</div>`;
        }

        return productsHTML;
    }

</script>
<!--  Get Categories Products End  -->
@section('custom-style')
    <style>
        .page-link{
            color: #3c3b6e !important;
        }

        .active>.page-link, .page-link.active {
            background-color: #b22234 !important;
            border-color: #3c3b6e !important;
            color: #FFFFFF !important;
            z-index: 0;
        }
        .loading-products{
            background:red; z-index:8; background: #00000057; border-radius: 20px;display: none;
        }
        @keyframes lightToDark {
        0% {
            background-color: #58575757; /* Light color */
            filter: brightness(1); /* Full brightness */
        }
        50% {
            background-color: #00000057; /* Dark color */
            filter: brightness(0.5); /* Half brightness */
        }
        100% {
            background-color: #58575757; /* Dark color */
            filter: brightness(1); /* Half brightness */
        }
        }

        .loading-products {
        animation: lightToDark 1.5s infinite alternate; /* Alternate animation direction */
        }

    </style>
@endsection
@section('content')
    <div class="container-fluid py-5 " style="background: #FFFFFF;">
        <div class="row">
            <div class="col-12">
                <nav class="mt-4 px-5 mb-2" aria-label="breadcrumb" style="padding-left: 2.5rem !important;">
                    <ol class="breadcrumbs">
                        <li><a href="{{ url('/') }}">HOME</a></li>
                        <li>{{ $category }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-dynamic">
                <h1 class="mt-3 mb-3 category-product-heading" style="font-size: 4.5rem ">{{ $subcategory }}</h1>
                <div class="row ">
                    <div class="col-12 mt-4 btn-tag-wrapper d-flex justify-content-end align-items-center" >

                            {{-- <nav aria-label="..." class="product-pagination">

                            </nav> --}}

                            <div>
                                <select name="" id="product-sort-filter" class="form-select form-select-lg "  style="border-radius: 10px !important;">
                                    <option value="0">Default</option>
                                    <option value="0">Date - (Oldest to Latest)</option>
                                    <option value="1">Date - (Latest to Oldest)</option>
                                    <option value="2">Name - (A to Z)</option>
                                    <option value="3">Name - (Z to A)</option>
                                    <option value="4">Price - (Low to High)</option>
                                    <option value="5">Price - (Hi to Low)</option>
                                </select>
                            </div>
                    </div>
                </div>
                <hr class="mb-5">
                <div class="product-section mb-3  px-product-section" style="position: relative;">
                    <div class="product-grid">

                        {{-- {!! $products !!} --}}
                    </div>

                    <div class="loading-products text-center" style="">
                        <div class="row">
                            <div class="col-12 text-center d-flex justify-content-center align-items-center" style="width: 100% !important; height: 20rem !important ;">
                                <h3 class="text-center">
                                    Loading <i class="fa-solid fa-arrows-rotate "></i>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pagination-cover">

                        <nav aria-label="..." class="product-pagination">

                        </nav>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                var currentURL = window.location.href;
                var categoryId = {{ $categoryId }};
                if (!currentURL.includes("search")) {

                    var category_list = $('.category-list');
                    category_list.hide();

                    var subCategory = $('.' + categoryId);
                    var id = subCategory.data('parent_id');

                    // var list_values_to_show = $('#' + id + '-list');
                    var list_values_to_show = $('.' + id + '-list');

                    // subCategory.parent().addClass('active-category');
                    subCategory.children().addClass('active-category');
                    list_values_to_show.fadeIn();

                    list_values_to_show.on('click', '.back-to-category', function() {
                        category_list.fadeIn();
                        list_values_to_show.hide();

                    });
                }else{
                    $('#' + categoryId).addClass('active-category');
                }
            }, 550);

        });
    </script>
@endsection
