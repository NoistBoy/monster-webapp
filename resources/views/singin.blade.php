@extends('layout-parshal.layout-parshal')


@section('content')
    <div class="container">
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
    </div>
@endsection
