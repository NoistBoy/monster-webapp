@extends('layout-parshal.layout-parshal')



@section('content')
    <section class="h-100 h-custom" style="background-color: #f8f9fa; ">
        <div class="container py-5 h-100" >
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="{{ Url('/') }}" class="text-body continue-shiping"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Continue shopping</a></h5>
                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Shopping cart</p>
                                            <p class="mb-0">You have <span class="cart-count-main fw-bold" >0</span> items in your cart</p>
                                        </div>
                                        {{-- <div>
                                            <p class="mb-0"><span class="text-muted">Sort by:</span> <a href="#!"
                                                    class="text-body">price <i class="fas fa-angle-down mt-1"></i></a></p>
                                        </div> --}}
                                    </div>

                                    <div class="cart-item-wrapper">
                                        @if ($cartItems && !$cartItems['hasError'])
                                            @foreach ($cartItems['result']['cartLineItemDtoList'] as $cartLineItem)
                                            <!-- Single Cart item -->
                                            @if ($cartLineItem['quantity'] > 0)
                                            <div class="card mb-3" id="cartItem-row-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['id'] }}" id="cart-id-of-{{ $cartLineItem['productId'] }}" >
                                                <div class="card-body" style="overflow-y: hidden;">
                                                    <div class="d-flex justify-content-between gap-10">
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div data-image-of-{{ $cartLineItem['productId'] }}="{{ $cartLineItem['imageUrl'] }}" >
                                                                <img src=" {{ !empty($cartLineItem['imageUrl']) && $cartLineItem['imageUrl'] !== "null" ? $cartLineItem['imageUrl'] : asset('asset/img/place-holder.jpeg') }}"
                                                                    class="img-fluid rounded-3" alt="Shopping item"
                                                                    style="width: 65px;">
                                                            </div>
                                                            <div class="ms-3" style="width:21rem;">
                                                                <h6>{{  $cartLineItem['productName'] }}</h6>
                                                                {{-- <p class="small mb-0">SKU <span>{{ $cartLineItem['sku'] ?? "--" }}</span></p> --}}
                                                                <p class="small mb-0 text-grey-dark " style="font-weight: 600;" data-sku-of-{{ $cartLineItem['productId']}}="{{ $cartLineItem['sku'] }}" >Stock: <span>{{ $cartLineItem['availableQuantity'] }}</span></p>
                                                            </div>
                                                            <div class="ms-3">
                                                                <p class=" mb-0 fw-bold monster-primary" data-upc-of-{{ $cartLineItem['productId'] }}="{{ $cartLineItem['upc'] }}"  >$ <span>{{ $cartLineItem['standardPrice'] }}</span></p>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center">
                                                            <div style="width: 50px;">
                                                                {{-- <h5 class="fw-normal mb-0">{{ $cartLineItem['quantity'] }}</h5> --}}
                                                                <div class="var-quantity d-flex flex-grow-0 gap-2 flex-column">
                                                                    <div class="quantity-input d-flex justify-center align-items-center gap-2">

                                                                        <button data-productID="{{ $cartLineItem['productId'] }}" class="quantity-minus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="2" viewBox="0 0 10 2" fill="none">
                                                                                <path d="M0 2V0H10V2H0Z" fill="#BDC2C7"></path>
                                                                            </svg>
                                                                        </button>

                                                                        <input type="number" value="{{ $cartLineItem['quantity'] }}"  data-stock-of-{{ $cartLineItem['productId'] }}="{{ $cartLineItem['availableQuantity'] }}"   class="quantity-input tag-btn-text" name="" id="" disabled style="width: 60px; height:52px; border-radius: 21px; border-width: 1px; border-style: solid; border-color: #bdc2c7; font-style: normal; font-weight: 500;  font-size: x-large; text-align: center; padding-left: 15px;">

                                                                        <button data-productID="{{ $cartLineItem['productId'] }}" class="quantity-plus d-flex align-items-center justify-center rounded-full bg-grey-extralight" style="width: 22px; height:22px; border: none;">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 10 10" fill="none">
                                                                                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 0H4L4 4H0V6H4L4 10H6V6H10V4H6V0Z" fill="#BDC2C7"></path>
                                                                            </svg>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div style="width: 100px;">
                                                                {{-- <h5 class="mb-0">{{ $cartLineItem['standardPrice'] }}</h5> --}}
                                                            </div>
                                                            <a href="javascript:void(0)" onclick="deleteCartItem({{ $cartLineItem['id'] }},{{ $cartLineItem['productId'] }})" style="color: #cecece;"><i class="fas fa-trash-alt text-danger"></i></a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <input type="hidden" value="{{ $cartLineItem['serviceProduct'] ?? 'null'}}" id="serviceProduct-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['size'] ?? 'null'}}" id="size-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxAmount'] }}" id="taxAmount-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['maxCostPrice'] }}" id="maxCostPrice-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['directTaxPercentage'] ?? 'null' }}" id="directTaxPercentage-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxPerOunce'] ?? 'null' }}" id="taxPerOunce-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxIncludedInSellingPrice'] ?? 'null'}}" id="taxIncludedInSellingPrice-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['discount'] }}" id="discount-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['updatedTimestamp'] }}" id="updatedTimestamp-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['insertedTimestamp'] }}" id="insertedTimestamp-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['updatedBy'] ?? 'null'}}" id="updatedBy-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['imageUrl'] ?? 'null' }}" id="imageUrl-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['cartLineItemUpdated'] ?? 'null'}}" id="cartLineItemUpdated-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['quantityIncrement'] }}" id="quantityIncrement-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['outOfStock'] ?? 'false'}}" id="outOfStock-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxPerVolume'] }}" id="taxPerVolume-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxPercentage'] }}" id="taxPercentage-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxType'] ?? 'null'}}" id="taxType-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxClassId'] ?? 'null'}}" id="taxClassId-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['discountAmount'] }}" id="discountAmount-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['discountType'] ?? 'null' }}" id="discountType-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['discountValue'] }}" id="discountValue-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['deleted'] ?? 'false'}}" id="deleted-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['availableQuantity'] }}" id="availableQuantity-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['adminRetailPrice'] }}" id="adminRetailPrice-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['originalStandardPrice'] }}" id="originalStandardPrice-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['tierPrice'] }}" id="tierPrice-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['cartStandardPrice'] }}" id="cartStandardPrice-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['status'] ?? 'null' }}" id="status-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['storeId'] }}" id="storeId-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['quantity'] }}" id="quantity-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['sku'] ?? "null"}}" id="sku-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['upc'] ?? "null" }}" id="upc-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['taxAmount'] }}" id="taxAmount-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['costPrice'] }}" id="costPrice-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['minQuantityToSale'] }}" id="minQuantityToSale-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['maxQuantityToSale'] }}" id="maxQuantityToSale-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ $cartLineItem['quantityIncrement'] }}" id="quantityIncrement-of-{{ $cartLineItem['productId'] }}">
                                                {{-- <input type="hidden" value="{{ $cartLineItem['sequenceNumber'] }}" id="sequenceNumber-of-{{ $cartLineItem['productId'] }}"> --}}
                                                <input type="hidden" value="{{ $cartLineItem['productName'] }}" id="productName-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ (Session::has('user.accessToken') ? $cartLineItem['standardPrice'] : 'XX.XX') }}" id="standardPriceWithoutDiscount-of-{{ $cartLineItem['productId'] }}">
                                                <input type="hidden" value="{{ (Session::has('user.accessToken') ? $cartLineItem['standardPrice'] : 'XX.XX') }}" id="standardPrice-of-{{ $cartLineItem['productId'] }}">
                                            </div>
                                            @endif
                                            <!-- Single Cart item End-->
                                            @endforeach
                                        @endif

                                    </div>

                                </div>
                                <div class="col-lg-5">

                                    <div class="card bg-light-gray card-detail-section rounded-3">
                                        <div class="card-body">

                                            <div class="d-flex justify-content-between mb-1 ">
                                                <p class="mb-2">Total CartQuantity</p>
                                                <p class="mb-2 totalCartQuantity">{{ $cartItems['result']['totalCartQuantity'] ?? 0 }}</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-1">
                                                <p class="mb-2">Cart SubTotal</p>
                                                <p class="mb-2 cartSubTotal">{{ $cartItems['result']['cartSubTotal'] ?? 0}}</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Cart Discount</p>
                                                <p class="mb-2 cartDiscount">{{ $cartItems['result']['cartDiscount'] ?? 0 }}%</p>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between my-4">
                                                <p class="mb-2">Total Cart Price</p>
                                                <p class="mb-2 totalCartPrice ">{{ $cartItems['result']['totalCartPrice'] ?? 0}}</p>
                                            </div>

                                            <a href="{{ url('/check-out') }}" class="btn btn-check-out w-100 btn-block btn-lg">
                                                <div class="d-flex justify-content-between">
                                                    <span class="total-cart-price-checkout" >{{ $cartItems['result']['totalCartPrice'] ?? 0 }}</span>
                                                    <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                </div>
                                            </a>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('custom-scripts')
        @include('layout.product-cart-script')
@endsection
