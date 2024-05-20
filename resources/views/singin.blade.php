@extends('layout-parshal.layout-parshal')


@section('content')
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start py-5">
        <style>
            .cascading-right {
                margin-right: -50px;
            }

            @media (max-width: 991.98px) {
                .cascading-right {
                    margin-right: 0;
                }
            }
        </style>

        <!-- Jumbotron -->
        <div class="container py-4">
            <div class="row g-0 align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="card cascading-right bg-body-tertiary"  style=" backdrop-filter: blur(30px);">
                        <div class="card-body p-5 shadow-5 text-center">
                            <h2 class="fw-bold">Sign in to your account</h2>
                            <p class="text-secondary  mb-5">Enter your credentials below to access your account.</p>
                            <form  id="singIn-form" >
                                <!-- 2 column grid layout with text inputs for the first and last names -->

                                <!-- User Name -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label for=""  class="fw-bold" style="float: left;" >User Name <span class="text-danger fw-bold">*</span></label>
                                    &nbsp;&nbsp;<small id="username_error" style="float: left;"  class="error-message text-danger fw-bold "></small>
                                        <input type="text" name="username" class="form-control reset form-control-lg" required>

                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-1" style="position: relative;">
                                    <label for=""  class="fw-bold" style="float: left;" >Password <span class="text-danger fw-bold">*</span></label>
                                    &nbsp;&nbsp;<small id="password_error" style="float: left;"  class="error-message text-danger fw-bold "></small>
                                    <input type="password" name="password" class="form-control reset form-control-lg" id="user-password" required>
                                    <i  data-passId="user-password" class="fa-regular fa-eye showPassword" style="    position: absolute;
                                                top: 41px;
                                                right: 20px;" ></i>
                                </div>
                                <p class="signin mb-3 mt-1" style="text-align: left;" ><a href="{{ Url('/forgot-password') }}" class="nav-link" > Forgot Password? </a> </p>

                                <!-- Submit button -->
                                <button class="btn mb-2 auth-form-btn w-100" id="singin-account">Sign in</button>
                                <p class="signin my-1" style="text-align: left;" >Don't have an account? <a href="{{ Url('/sign-up') }}">Sign up</a> </p>

                                <!-- Register buttons -->
                                {{-- <div class="text-center">
                                    <p>or sign up with:</p>
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>

                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-google"></i>
                                    </button>

                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-twitter"></i>
                                    </button>

                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-link btn-floating mx-1">
                                        <i class="fab fa-github"></i>
                                    </button>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0">
                    {{-- <img src="https://mdbootstrap.com/img/new/ecommerce/vertical/004.jpg" class="w-100 rounded-4 shadow-4"
                alt="" /> --}}
                    <img src="{{ asset('asset/img/login.jpeg') }}" class="w-100 rounded-4 shadow-4" alt="" />
                </div>
            </div>
        </div>
        <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
    {{-- ///////////////////////////// --}}
    {{-- <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <form class="form d-flex flex-column my-4 py-5 px-3 w-100 singup-form" id="singIn-form">
                    <div class="mb-3">
                        <h1 class="fw-bold monster-primary" >Sign in to your account</h1>
                        <p class="text-secondary">Enter your credentials below to access your account.</p>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-12">
                            <label for="">User Name <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="text" name="username" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="username_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="">Password <span class="text-danger">*</span></label>
                            <div class="">
                                <input type="password" name="password" class="form-control reset form-control-lg" required>
                                &nbsp;<small id="password_error" class="error-message text-danger fw-bold "></small>
                            </div>
                        </div>
                    </div>

                    <button class="btn mb-2 auth-form-btn " id="singin-account">Sing in</button>
                    <p class="signin">Don't have an account? <a href="{{ Url('/sign-up') }}">Sign up</a> </p>

                </form>
            </div>
        </div>
    </div> --}}
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function() {

            $('.showPassword').click(function() {
                passId = $(this).data('passid');
                console.log("The PassId" + passId);
                let pass = $('#'+passId);
                let icon = $(this);
                togglePasswordVisibility(pass, icon);
            });

        });

            function togglePasswordVisibility(pass, icon) {
                pass.attr('type', pass.attr('type') === 'password' ? 'text' : 'password');
                icon.toggleClass('fa-eye fa-eye-slash');
            }
    </script>
@endsection
