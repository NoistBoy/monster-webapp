@extends('layout-parshal.layout-parshal')

<style>
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    p {
        color: grey
    }



    #placeOrder-form {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #placeOrder-form fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        /* padding-bottom: 20px; */
        position: relative
    }

    .form-checkOut-card {
        text-align: left
    }

    #placeOrder-form fieldset:not(:first-of-type) {
        display: none
    }


    #placeOrder-form input,
    #placeOrder-form textarea {
        padding: 8px 15px 8px 15px;
        border: 1px solid #ccc;
        border-radius: 0px;
        /* margin-bottom: 25px; */
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;

        font-size: 16px;
        letter-spacing: 1px
    }






    #placeOrder-form .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px 10px 0px;
        float: right
    }

    #placeOrder-form .action-button-previous:hover,
    #placeOrder-form .action-button-previous:focus {
        background-color: #000000
    }

    .checkOut-card {
        z-index: 0;
        border: none;
        position: relative
    }




    .steps {
        font-size: 25px;
        color: gray;
        margin-bottom: 10px;
        font-weight: normal;
        text-align: right
    }

    .fieldlabels {
        color: gray;
        text-align: left
    }

    #progressbar {
        padding-left: 0px;
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }



    #progressbar li {

        list-style-type: none;
        font-size: 15px;
        width: 20%;
        float: left;
        position: relative;
        font-weight: 400
    }

    #progressbar #billing:before {
        font-family: FontAwesome;
        content: "\f15c"
    }

    #progressbar #shiping:before {
        font-family: FontAwesome;
        content: "\f48b"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f09d"
    }
    #progressbar #review:before {
        font-family: FontAwesome;
        content: "\f002"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 20px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }



    .progress {
        height: 20px
    }



    .fit-image {
        width: 100%;
        object-fit: cover
    }
    .input-radio, .paymentMethods-radio{
        margin-bottom: 0 !important;
    }

    .radio-wrapper{
        padding: 5px 5px;
        cursor: pointer;
    }
    .radio-wrapper label{
        cursor: pointer !important;
    }

</style>


@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-8">
            <div class="container-fluid mb-5 " style="padding-left: 3rem;">
                <div class="row justify-content-center">
                    <div class="col-11 col-sm-10 col-md-10 col-lg-6 col-xl-5 text-center p-0 mt-3 mb-2" style="width:90%;">
                        <div class="checkOut-card px-0 pt-4 pb-0 mt-3 mb-3">
                            <h2 id="checkout-heading" class="fw-bold">Payment Information</h2>
                            <p>Please provide your payment details to complete your purchase</p>
                            <form id="placeOrder-form" method="POST"  >
                                <!-- Button trigger modal -->
                                <!-- progressbar -->
                                <ul id="progressbar">
                                    <li class="active" id="billing"><strong>Billing </strong></li>
                                    <li id="shiping"><strong>Shipping </strong></li>
                                    <li id="payment"><strong>Payment </strong></li>
                                    <li id="review"><strong>Review</strong></li>
                                    <li id="confirm"><strong>Finish</strong></li>
                                </ul>
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated " role="progressbar"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div> <br> <!-- fieldsets -->
                                <fieldset>
                                    <div class="form-checkOut-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Billing Information</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 1 - 4</h2>
                                            </div>
                                        </div>

                                            <div class="row mt-3 px-2 mb-5">
                                                <select class="form-select form-select-lg"  name="Shiping-Address" id="Shiping-Address">
                                                    @if (!empty($customerAddresslist))
                                                        @foreach ( $customerAddresslist as $customerAddresslist)
                                                            <option value="{{ $customerAddresslist['id'] }}">{{ $customerAddresslist['address1'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                {{-- <input type="email" name="email" placeholder="Email Id" /> --}}
                                            </div>
                                            <div class="row" id="add-customer-address" style="display: none;">
                                                <div class="col-12 mb-3">
                                                    <h3>Add Billing Address</h3>
                                                </div>
                                                <div class="col-12 mb-3 ">
                                                    <input type="text" name="address1" value="" class="form-control form-control-lg reset" id="customer-address1" placeholder="Address 1 *">
                                                    <small class="text-danger fw-bold px-2 "  id="customer-address1-error" ></small>
                                                </div>
                                                <div class="col-4 mb-3 ">
                                                    <input type="text" name="address2" value="" class="form-control form-control-lg reset" id="customer-address2" placeholder="Address 2">
                                                </div>
                                                <div class="col-4 mb-3 ">
                                                    <select name="country" id="country_id" class="form-select form-select-lg reset" required>
                                                        @if ($countries)
                                                        <?php $country = $countries;?>
                                                        <option value="">---- Please Select ----</option>
                                                            @foreach ($country as $countries)
                                                                <option value="{{ $countries['id'] }}">{{ $countries['name'] }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                    <small class="text-danger fw-bold px-2 "  id="country_id-error" ></small>
                                                </div>
                                                <div class="col-4 mb-3 ">
                                                    <select  name="state_id" id="state_id" class="form-select form-select-lg reset" disabled></select>
                                                    <small class="text-danger fw-bold px-2 "  id="state_id-error" ></small>
                                                </div>
                                                <div class="col-4 mb-3 ">
                                                    <input type="text" name="city" value="" class="form-control form-control-lg reset" id="customer-city" placeholder="City *">
                                                    <small class="text-danger fw-bold px-2 "  id="customer-city-error" ></small>
                                                </div>
                                                <div class="col-4 mb-3 ">
                                                    <input type="text" name="postalCode" class="form-control form-control-lg reset" id="customer-postalCode" placeholder="Zip/Postal Code *">
                                                    <small class="text-danger fw-bold px-2 "  id="customer-postalCode-error" ></small>
                                                </div>
                                                <div class="col-4 mb-3 ">
                                                    <input type="text" name="phone" id="customer-phone" class="form-control form-control-lg reset"  placeholder="Phone *">
                                                    <small class="text-danger fw-bold px-2 "  id="customer-phone-error" ></small>
                                                </div>
                                                <div class="col-4 mb-3">
                                                    <button class="btn bg-monster-primary" id="add-new-address">Add Address</button>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-6 mb-3 px-4" >
                                                    <div class="billingDetails-wrapper radio-active radio-label row d-flex justify-content-center align-baseline align-items-baseline" style="cursor: pointer;">
                                                        <div class="col-1">
                                                            <input type="radio" name="billingDetails" checked class="input-radio billingDetails-radio" id="same-address" value="dd" >
                                                        </div>
                                                        <div class="col-9">
                                                            <label class="fw-bold " for="same-address" style="width: -webkit-fill-available; cursor: pointer;">
                                                                Deliver to this address
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6 mb-3 px-4" >
                                                    <div class="billingDetails-wrapper radio-label row d-flex justify-content-center align-baseline align-items-baseline" style="cursor: pointer;">
                                                        <div class="col-1">
                                                            <input type="radio" name="billingDetails"  class="input-radio billingDetails-radio" id="different-address" value="dd" >
                                                        </div>
                                                        <div class="col-9">
                                                            <label class="fw-bold " for="different-address" style="width: -webkit-fill-available; cursor: pointer;">
                                                                Deliver to a different address
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    <input type="button" name="next" class="action-button parse-billing-details" value="Next" />
                                    <input type="button" name="next" class="next action-button" value="Next" style="display: none;"/>
                                </fieldset>

                                <fieldset>
                                    <div class="form-checkOut-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Shipping Method</h2>
                                                <small class="text-danger fw-bold" id="shiping-method-error" ></small>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 2 - 4</h2>
                                            </div>
                                        </div>
                                        @if (!$shipingMethods['hasError'])

                                            <div class="row mt-5">
                                                @foreach ($shipingMethods['result'] as $shipingMethods)
                                                    @if ($shipingMethods['active'])
                                                        <div class="col-6 mb-3 px-4" >
                                                            <div class="radio-wrapper radio-label row d-flex justify-content-center align-baseline align-items-baseline">
                                                                <div class="col-1">
                                                                    <input type="radio" name="shipingMethod" data-shipping-label="{{ $shipingMethods['name']."&nbsp; - &nbsp;$ ".$shipingMethods['amount'] }}" class="input-radio " id="{{ $shipingMethods['id'] }}" value="{{ $shipingMethods['id'].",".$shipingMethods['amount'] }}" >
                                                                    <input type="hidden" name="">
                                                                </div>
                                                                <div class="col-9">
                                                                    <label class="fw-bold " for="{{ $shipingMethods['id'] }}" style="width: -webkit-fill-available;">
                                                                        {{ $shipingMethods['name'] }}
                                                                    </label>
                                                                </div>
                                                                <div class="col-1">
                                                                    <span class="monster-primary fw-bold">${{ $shipingMethods['amount'] }}</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        @endif
                                    </div>
                                    <input type="button" name="next" class="action-button shiping-methods-parse " value="Next" />
                                    <input type="button" name="next" class="next action-button" value="Next" style="display: none;"/>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>

                                <fieldset>
                                    <div class="form-checkOut-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Payment Method</h2>
                                                <small class="fw-bold text-danger" id="PaymentMethods-error"></small>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 3 - 4</h2>
                                            </div>
                                        </div>
                                        <div class="row mt-3" id="add-CreditCard" style="display: none;">
                                            <div class="col-12 mb-3">
                                                <h3>Add Credit Card</h3>
                                            </div>
                                            <div class="col-6 mb-3 ">
                                                <input type="text" name="firstName" value="" class="form-control form-control-lg reset" id="firstName" placeholder="First Name *">
                                                <small class="text-danger fw-bold px-2 "  id="firstName-error" ></small>
                                            </div>
                                            <div class="col-6 mb-3 ">
                                                <input type="text" name="lastName" value="" class="form-control form-control-lg reset" id="lastName" placeholder="Last Name *">
                                                <small class="text-danger fw-bold px-2 "  id="lastName-error" ></small>
                                            </div>

                                            <div class="col-12 mb-3 ">
                                                <input type="number" name="cardNumber" value="" class="form-control form-control-lg reset" id="cardNumber" placeholder="Card Number *">
                                                <small class="text-danger fw-bold px-2 "  id="cardNumber-error" ></small>
                                            </div>
                                            <div class="col-4 mb-3 ">
                                                <input type="number" name="expirationMonth" value="" max="2" class="form-control form-control-lg reset" id="expirationMonth" placeholder="Expiration Month  MM *">
                                                <small class="text-danger fw-bold px-2 "  id="expirationMonth-error" ></small>
                                            </div>
                                            <div class="col-4 mb-3 ">
                                                <input type="number" name="expirationYear" value="" class="form-control form-control-lg reset" id="expirationYear" placeholder="Expiration Year  YY *">
                                                <small class="text-danger fw-bold px-2 "  id="expirationYear-error" ></small>
                                            </div>
                                            <div class="col-4 mb-3 ">
                                                <input type="number" name="cvv" id="cvv" class="form-control form-control-lg reset" placeholder="CVC/CVV *">
                                                <small class="text-danger fw-bold px-2 "  id="cvv-error" ></small>
                                            </div>
                                            <div class="col-12 mb-3 ">
                                                <input type="text" name="credit-card-address" value="" class="form-control form-control-lg reset" id="credit-card-address" placeholder="Address *">
                                                <small class="text-danger fw-bold px-2 "  id="credit-card-address-error" ></small>
                                            </div>

                                            <div class="col-3 mb-3 ">
                                                {{-- <input type="text" name="credit-card-country" class="form-control form-control-lg reset" id="credit-card-country" placeholder="Country *"> --}}
                                                <select name="credit-card-country" id="credit-card-country" class="country_id_class form-select form-select-lg reset" required>
                                                    @if ($cntry)
                                                    <option value="">---- Please Select ----</option>
                                                        @foreach ($cntry as $countries)
                                                            <option value="{{ $countries['id'] }}">{{ $countries['name'] }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <small class="text-danger fw-bold px-2 "  id="credit-card-country-error" ></small>
                                            </div>
                                            <div class="col-3 mb-3 ">
                                                <select  name="credit-card-state" id="credit-card-state" class="state_id_class form-select form-select-lg reset " disabled></select>
                                                &nbsp;<small id="credit-card-state-error" class="error-message text-danger fw-bold "></small>

                                                {{-- <input type="text" name="credit-card-state" id="credit-card-state" class="form-control form-control-lg reset"  placeholder="State *">
                                                <small class="text-danger fw-bold px-2 "  id="credit-card-state-error" ></small> --}}
                                            </div>
                                            <div class="col-3 mb-3 ">
                                                <input type="text" name="credit-card-city" id="credit-card-city" class="form-control form-control-lg reset"  placeholder="City *">
                                                <small class="text-danger fw-bold px-2 "  id="credit-card-city-error" ></small>
                                            </div>
                                            <div class="col-3 mb-3 ">
                                                <input type="text" name="credit-card-zipcode" id="credit-card-zipcode" class="form-control form-control-lg reset"  placeholder="Zip code *">
                                                <small class="text-danger fw-bold px-2 "  id="credit-card-zipcode-error" ></small>
                                            </div>

                                            {{-- <div class="col-4 mb-3">
                                                <button class="btn bg-monster-primary" id="add-creditcard">Add Credit Card</button>
                                            </div> --}}
                                        </div>
                                        @if (!$PaymentMethods['hasError'])

                                            <div class="row mt-5">
                                                @foreach ($PaymentMethods['result'] as $PaymentMethods)
                                                    @if ($PaymentMethods['ecommerce'])
                                                        <div class="col-6 mb-3 px-4" >
                                                            <div class="radio-wrapper paymentMethods-wrapper radio-label row d-flex justify-content-center align-baseline align-items-baseline">
                                                                <div class="col-3">
                                                                    <input type="radio" name="PaymentMethods" data-label="{{ $PaymentMethods['name'] }}"  class="{{strtolower(str_replace(' ', '', $PaymentMethods['name']))  }}-option paymentMethods-radio" id="payment-option-{{ $PaymentMethods['id'] }}" value="{{ $PaymentMethods['id'] }}" >
                                                                </div>
                                                                <div class="col-9">
                                                                    <label class="fw-bold " for="payment-option-{{ $PaymentMethods['id'] }}" style="width: -webkit-fill-available;">
                                                                        {{ $PaymentMethods['name'] }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>

                                        @endif
                                    </div>

                                    <input type="button" name="next" class="PaymentMethods-parse action-button" value="Next" />
                                    <input type="button" name="next" class="next action-button" value="Next" style="display: none;"/>
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-checkOut-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Order Review</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div>

                                        <div class="row">
                                            @if ($cartLineItem)
                                            <div class="col-12 mb-3" style="min-height: 10rem; max-height: 22rem; overflow-x: hidden;">

                                                    @foreach ($cartLineItem as $cartItems )

                                                    <div class="card mb-2" >
                                                        <div class="row py-2 px-3 d-flex justify-content-center align-items-center" >
                                                            <div class="col-2 fw-bold">
                                                                <img src="{{ $cartItems['imageUrl'] ?? asset('asset/img/place-holder.jpeg') }}" class=" img-thumbnail img-fluid w-50" alt="" srcset="">
                                                                {{-- ID:&nbsp;#{{ $cartItems['id'] }} --}}
                                                            </div>
                                                            <div class="col-6" style="font-weight: 500;" >{{ $cartItems['productName'] }}</div>
                                                            <div class="col-2" style="font-weight: 500;" >{!! $cartItems['quantity']."&nbsp;X&nbsp;".$cartItems['originalStandardPrice'] !!}</div>
                                                            <input type="hidden" name="order-totalQuantity" value="{{ $cartItems['quantity'] }}">
                                                            <div class="col-2" style="font-weight: 500;" >$ {{ $cartItems['quantity']*$cartItems['originalStandardPrice'] }}</div>
                                                        </div>
                                                    </div>

                                                    @endforeach
                                                </div>
                                                <div class="mb-0 text-right px-5">
                                                    <div class="row mb-2">
                                                        <div class="col-3 offset-md-7 fw-bold">Total({{ $totalCartQuantity }} items)</div>
                                                        <div class="col-2 fw-bold">$ {{ $cartSubTotal }}</div>
                                                        <input type="hidden" name="cartSubTotal" value="{{ $cartSubTotal }}">
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-3 offset-md-7 fw-bold">Shipping&nbsp;Charges</div>
                                                        <div class="col-2 fw-bold">$ {{ 0 }}</div>
                                                    </div>
                                                    <div class="row mb-4">
                                                        <div class="col-3 offset-md-7 fw-bold">Tax Charges</div>
                                                        <div class="col-2 fw-bold">$ {{ 0 }}</div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <hr>
                                                        <div class="col-3 offset-md-7 fw-bold">Grand Total</div>
                                                        <div class="col-2 fw-bold">$ {{ $totalCartPrice }}</div>
                                                        <input type="hidden" name="totalCartPrice" value="{{ $totalCartPrice }}">
                                                        <input type="hidden" name="cartDiscount" value="{{ $cartDiscount }}">
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <p class="fs-4">Your Comment</p>
                                                    </div>
                                                    <div class="col-1"><i class="fa-solid fa-user-large monster-primary"></i></div>
                                                    <div class="col-11">
                                                        <textarea name="customer-notes" id="" cols="30" rows="3" class="w-100">Comment on this order</textarea>
                                                    </div>
                                                </div>
                                                @endif
                                        </div>

                                    </div>

                                    <input type="button" name="next" class="action-button" id="place-customer-orders" value="Place Order" style="width:180px;" />
                                    <input type="button" name="next" class="next action-button" id="place-customer-orders-parse" value="Place Order" style="display:none;" />
                                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                </fieldset>
                                <fieldset>
                                    <div class="form-checkOut-card">
                                        <div class="row">
                                            <div class="col-7">
                                                <h2 class="fs-title">Order Review</h2>
                                            </div>
                                            <div class="col-5">
                                                <h2 class="steps">Step 4 - 4</h2>
                                            </div>
                                        </div> <br><br>
                                        <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                        <div class="row justify-content-center">
                                            {{-- <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image">
                                            </div> --}}
                                        </div> <br><br>
                                        <div class="row justify-content-center">
                                            <div class="col-7 text-center">
                                                <h5 class="purple-text text-center">Order Place Successfully</h5>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 pt-5" style="padding-right: 3rem; padding-left: 0;">
            <div class="card bg-light-gray card-detail-section rounded-3 mt-5 mb-5 pb-3">
                <div class="card-body">

                    <div class="d-flex justify-content-between mb-1 ">
                        <p class="mb-2 fs-3 fw-bold" style="color:#163029 !important;">Total Order Cost:</p>
                        <span class="fs-2 fw-bold total-cart-price-checkout" style="color:#163029 !important;"></span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-1 ">
                        <p class="mb-2 fs-3 fw-bold" style="color:#163029 !important;">Billing Details</p>
                    </div>
                    <div class="d-flex justify-content-between mb-1 ">
                        <p class="mb-2 info-billing-detail" style="color:#163029 !important;">- - - - </p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-1 ">
                        <p class="mb-2 fs-3 fw-bold" style="color:#163029 !important;">Shipping Method</p>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <p class="mb-0 info-shippingMethods" style="color:#163029 !important;">- - - -</p>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-1 ">
                        <p class="mb-2 fs-3 fw-bold" style="color:#163029 !important;">Payment Method</p>
                    </div>
                    <div class="d-flex justify-content-between mb-1">
                        <p class="mb-0 info-paymenyMethod" style="color:#163029 !important;">----</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('custom-scripts')
    <script>
        $(document).ready(function () {
            $('.info-billing-detail').html($('#Shiping-Address option:first').text());
            $('#Shiping-Address').change(function () {
                $('.info-billing-detail').html($('#Shiping-Address option:selected').text());
            });
            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;

            setProgressBar(current);

            $(".next").click(function () {
                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate(
                    { opacity: 0 },
                    {
                        step: function (now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            display: "none",
                            position: "relative"
                        });
                        next_fs.css({ opacity: opacity });
                        },
                        duration: 500
                    }
                );
            setProgressBar(++current);
        });

        $(".previous").click(function () {
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li")
            .eq($("fieldset").index(current_fs))
            .removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate(
            { opacity: 0 },
            {
                step: function (now) {
                // for making fielset appear animation
                opacity = 1 - now;

                current_fs.css({
                    display: "none",
                    position: "relative"
                });
                previous_fs.css({ opacity: opacity });
                },
                duration: 500
            }
            );
            setProgressBar(--current);
        });

        function setProgressBar(curStep) {
            var percent = parseFloat(100 / steps) * curStep;
            percent = percent.toFixed();
            $(".progress-bar").css("width", percent + "%");
        }

        $(".submit").click(function () {
            return false;
        });
        });
        $(document).ready(function () {
            $('.input-radio').change(function() {

                $('.radio-wrapper').removeClass('radio-active');
                $(this).closest('.radio-wrapper').addClass('radio-active');
                $('.info-shippingMethods').html($(this).data('shipping-label'));
            });

            $('.paymentMethods-radio').change(function() {

                $('.info-paymenyMethod').html($(this).data('label'));

                $('.paymentMethods-wrapper').removeClass('radio-active');
                $(this).closest('.paymentMethods-wrapper').addClass('radio-active');

                if ($('.creditcard-option').is(':checked')) {
                    $('#add-CreditCard').fadeIn();
                    // $('.action-button').prop('disabled', true);

                } else {
                    $('#add-CreditCard').hide();
                    // $('.action-button').prop('disabled', false);
                }
            });

            $('.billingDetails-radio').change(function() {
                $('.billingDetails-wrapper').removeClass('radio-active');
                $(this).closest('.billingDetails-wrapper').addClass('radio-active');

                if ($('#different-address').is(':checked')) {
                    $('#add-customer-address').fadeIn();
                    $('.action-button').prop('disabled', true);

                } else {
                    $('#add-customer-address').hide();
                    $('.action-button').prop('disabled', false);
                }
            });

            $('.parse-billing-details').click(function (e) {
                e.preventDefault();
                var process = false;
                if ($('#add-customer-address').css('display') !== 'none') {

                    $('#customer-address1').val() != "" ? ($('#customer-address1-error').html(""), process = true) : ($('#customer-address1-error').html("Addredd1 is required!") ,process = false) ;

                    $('#country_id').val() != "" ? ($('#country_id-error').html(""), process = true) : ($('#customer-country-error').html("Country is required!"), process = false) ;
                    $('#state_id').val() != "" ? ($('#state_id-error').html(""), process = true) : ($('#customer-state-error').html("State is required!"), process = false);
                    $('#customer-city').val() != "" ? ($('#customer-city-error').html(""), process = true) : ($('#customer-city-error').html("City is required!"), process = false) ;
                    $('#customer-postalCode').val() != "" ? ($('#customer-postalCode-error').html(""), process = true) : ($('#customer-postalCode-error').html("PostalCode is required!"), process = false) ;
                    $('#customer-phone').val() != "" ? ($('#customer-phone-error').html(""), process = true) : ($('#customer-phone-error').html("Phone is required!"), process = false) ;

                    if(!process){
                        // $(this).closest('.parse-billing-details').next('.next').click();
                        $('.action-button').prop('disabled', true);
                    }
                }else{
                    $(this).closest('.parse-billing-details').next('.next').click();

                }

            });

            $('.shiping-methods-parse').click(function (e) {
                e.preventDefault();
                $('#shiping-method-error').text("");
                $('input[name="shipingMethod"]').is(':checked') ?  $(this).closest('.shiping-methods-parse').next('.next').click() : $('#shiping-method-error').text("Please select shiping method first.");

            });
            $('.PaymentMethods-parse').click(function (e) {
            debugger
                e.preventDefault();

                $('#PaymentMethods-error').text("");

                var process = false;
                if ($('#add-CreditCard').css('display') !== 'none'){
                    $('#firstName').val() != "" ? ($('#firstName-error').html(""), process = true) : ($('#firstName-error').html("First Name is required!") ,process = false) ;
                    $('#lastName').val() != "" ? ($('#lastName-error').html(""), process = true) : ($('#lastName-error').html("Last Name is required!"), process = false) ;
                    $('#cardNumber').val() != "" ? ($('#cardNumber-error').html(""), process = true) : ($('#cardNumber-error').html("Card Number is required!"), process = false);
                    $('#expirationMonth').val() != "" ? ($('#expirationMonth-error').html(""), process = true) : ($('#expirationMonth-error').html("Expiration Month is required!"), process = false) ;
                    $('#expirationYear').val() != "" ? ($('#expirationYear-error').html(""), process = true) : ($('#expirationYear-error').html("expiration Year is required!"), process = false) ;
                    $('#cvv').val() != "" ? ($('#cvv-error').html(""), process = true) : ($('#cvv-error').html("CVC/CVV is required!"), process = false) ;
                    $('#credit-card-address').val() != "" ? ($('#credit-card-address-error').html(""), process = true) : ($('#credit-card-address-error').html("Address is required!"), process = false) ;
                    $('#credit-card-country').val() != "" ? ($('#credit-card-country-error').html(""), process = true) : ($('#credit-card-country-error').html("Country is required!"), process = false) ;
                    $('#credit-card-state').val() != "" ? ($('#credit-card-state-error').html(""), process = true) : ($('#credit-card-state-error').html("State is required!"), process = false) ;
                    $('#credit-card-city').val() != "" ? ($('#credit-card-city-error').html(""), process = true) : ($('#credit-card-city-error').html("City is required!"), process = false) ;
                    $('#credit-card-zipcode').val() != "" ? ($('#credit-card-zipcode-error').html(""), process = true) : ($('#credit-card-zipcode-error').html("ZipCode is required!"), process = false) ;
                }else{
                    process = true;
                }

                if(process){
                    $('input[name="PaymentMethods"]').is(':checked') ?  $(this).closest('.PaymentMethods-parse').next('.next').click() : $('#PaymentMethods-error').text("Please select Payment Method first.");
                }

            });

            $('#add-new-address').click(function (e) {
                e.preventDefault();

                var process = false;
                if ($('#add-customer-address').css('display') !== 'none') {

                    $('#customer-address1').val() != "" ? ($('#customer-address1-error').html(""), process = true) : ($('#customer-address1-error').html("Addredd1 is required!") ,process = false) ;

                    $('#country_id').val() != "" ? ($('#country_id-error').html(""), process = true) : ($('#customer-country-error').html("Country is required!"), process = false) ;
                    $('#state_id').val() != "" ? ($('#state_id-error').html(""), process = true) : ($('#customer-state-error').html("State is required!"), process = false);
                    $('#customer-city').val() != "" ? ($('#customer-city-error').html(""), process = true) : ($('#customer-city-error').html("City is required!"), process = false) ;
                    $('#customer-postalCode').val() != "" ? ($('#customer-postalCode-error').html(""), process = true) : ($('#customer-postalCode-error').html("PostalCode is required!"), process = false) ;
                    $('#customer-phone').val() != "" ? ($('#customer-phone-error').html(""), process = true) : ($('#customer-phone-error').html("Phone is required!"), process = false) ;

                    if(process){
                        addCustomerAddress();
                    }

                }

            });

            $('#place-customer-orders').click(function (e) {
                e.preventDefault();

                let formData = new FormData($('#placeOrder-form')[0]);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/place-order",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        console.log(response);
                        if(response.hasError){
                            Toast.fire({
                                icon: `error`,
                                title: `${response.error.details}`
                            });
                        }else{
                            Toast.fire({
                                icon: `success`,
                                title: `Your order has been successfully placed!`
                            });
                            $('#place-customer-orders-parse').click();
                        }
                        // $('#loading-indicator').hide();
                        $('.action-button').prop('disabled', false);

                        getCartCount();
                    },
                    error: function(xhr, status, error) {
                        console.error(error);

                    }
                });

            });

        });
// ////////////////////////////////////////////////////////////// ///////////////////////////////////////
        function addCustomerAddress() {
            $('#loading-indicator').show();
            $('.action-button').prop('disabled', true);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/add-customerAddress",
                data: {
                    address1 : $('#customer-address1').val(),
                    address2 : $('#customer-address2').val(),
                    country : $('#country_id').val(),
                    state : $('#state_id').val(),
                    city : $('#customer-city').val(),
                    postalCode : $('#customer-postalCode').val(),
                    phone :  $('#customer-phone').val()
                },
                success: function (response) {
                    // $('#loading-indicator').hide();
                    $('.action-button').prop('disabled', false);

                    if(!response.hasError){
                        $('.reset').val("");
                        $('#add-customer-address').css('display', 'none');
                        $('#Shiping-Address').append(`<option value="${response.result.id}" selected >${response.result.address1}</option>`)
                        Toast.fire({
                            icon: "success",
                            title: `Address add Successfully!`
                        });
                    }else{
                        Toast.fire({
                            icon: "error",
                            title: `Something went wrong!`
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    // $('#loading-indicator').hide();
                    $('.action-button').prop('disabled', false);

                }
            });
        }


    </script>
@endsection
