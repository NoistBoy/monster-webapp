@extends('layout-parshal.layout-parshal')


@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <form class="form d-flex flex-column my-4 py-5 px-3 w-100 singup-form" id="singUp-form">
                    <div class="mb-3">
                        <h1 class="fw-bold monster-primary" >Apply for your account</h1>
                        <p class="text-secondary">Signup now and get full access to our app. </p>
                    </div>

                    {{-- Business Address --}}
                    <h4 class="fw-bold my-3">Your Business</h4>

                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="">Business Name <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="business_name" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="business_name_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">company <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="company" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="company_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="">Tax ID</label>
                            <div class="">
                                <input type="text" name="tax_id" class="form-control reset form-control-lg">
                                &nbsp;<small id="tax_id_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                    </div>

                    {{-- Business Address --}}
                    <h4 class="fw-bold my-3">Business Address</h4>

                    <div class="mb-3">
                        <label for="">Storefront Business Address <span class="text-danger">*</span></label>
                        <div class="">
                            <input type="text" name="business_address" class="form-control reset form-control-lg" required>
                            &nbsp;<small id="business_address_error" class="error-message text-danger fw-bold "></small>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="">Country<span class="text-danger">*</span></label>
                            <div class="">
                                <select name="country_id" id="country_id" class="form-select form-select-lg reset ">
                                    <option value="">---- Please Select ----</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                                &nbsp;<small id="country_id_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="">State <span class="text-danger">*</span></label>
                            <div class="">
                                <select  name="state_id" id="state_id" class="form-select form-select-lg reset " disabled></select>
                                &nbsp;<small id="state_id_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>

                    </div>

                    <div class="mb-3 row">

                        <div class="col-6">
                            <label for="">City <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="city" id="city" class="form-control reset form-control-lg " required>
                                &nbsp;<small id="city_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="">Zip/Postal Code <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="number" name="zipcode" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="zipcode_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                    </div>

                    {{-- Your Profile --}}
                    <h4 class="fw-bold my-3">Your Profile</h4>

                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="">First Name <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="firstname" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="firstname_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>

                        <div class="col-6">
                            <label for="">Last Name <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="lastname" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="lastname_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <div class="col-6">
                            <label for="">Email <span class="text-danger">*</span></label>
                            <div class="flex">
                                <input type="email" name="email" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="email_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Phone <span class="text-danger">*</span></label>
                            <div class="flex">
                                <input type="number" name="phone" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="phone_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                    </div>

                    <button class="btn mb-2 auth-form-btn" id="apply-for-account">Apply for account</button>
                    <p class="signin">Already have an acount ? <a href="{{ Url('/sign-in') }}">Sign in</a> </p>

                </form>
            </div>
        </div>
    </div>
@endsection
