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
                            <div class="mb-3" >
                                <h2 class="fw-bold">RESET PASSWORD</h2>
                                <p class="text-secondary  mb-2">Set a new password for your account.<br>
                                    <span id="password-head_error"  class=""> Password must be at least 6 characters long <span class="text-danger fw-bold" >*</span></span></p>

                            </div>

                            <form  id="forgotPassword-form" >
                                <!-- 2 column grid layout with text inputs for the first and last names -->

                                <!-- Password -->
                                <div data-mdb-input-init class="form-outline mb-4 position-relative">
                                    <label for=""  class="fw-bold" style="float: left;" >Password <span class="text-danger fw-bold">*</span></label>&nbsp;&nbsp;

                                    <small id="password_error" style="float: left;"  class="error-message text-danger fw-bold "></small>
                                    <input type="password" name="password" class="form-control form-control-lg reset position-relative" id="password" required>
                                    <i  data-passId="password" class="fa-regular fa-eye showPassword" style="    position: absolute;
                                    top: 41px;
                                    right: 20px;" ></i>
                                </div>
                                <!-- ConfirmPassword -->
                                <div data-mdb-input-init class="form-outline mb-4 position-relative">
                                    <label for=""  class="fw-bold" style="float: left;" >Confirm Password <span class="text-danger fw-bold">*</span></label>&nbsp;&nbsp;

                                    <small id="confirn-password_error" style="float: left;"  class="error-message text-danger fw-bold "></small>
                                    <input type="password" name="confirn-password" class="form-control form-control-lg position-relative reset" id="confirn-password" required>
                                    <i  data-passId="confirn-password" class="fa-regular fa-eye showPassword" style="    position: absolute;
                                    top: 41px;
                                    right: 20px;" ></i>
                                </div>
                                <!-- Submit button -->
                                <button class="btn mb-2 auth-form-btn w-100" id="reset-password"  >Reset Password</button>
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
@endsection


@section('custom-scripts')
    <script>

        $(document).ready(function () {
            $('#reset-password').click(function (e) {
                e.preventDefault();
                var process = true;
                var error = $('.error-message');
                error.text('');

                var password_error = $('#password_error');
                var Confirmpassword_error = $('#confirn-password_error');
                var passwordHead_error = $('#password-head_error');

                const email = "{{ $_GET['email'] }}";
                const token = "{{ $_GET['token'] }}";

                const password = $('#password').val();
                const Confirmpassword = $('#confirn-password').val();


                if (!password) {
                    password_error.text('Passwird is required.');
                    process = false;
                }
                if (!Confirmpassword) {
                    Confirmpassword_error.text('Confirm Passwird is required.');
                    process = false;
                }
                if (password.length < 6) {
                    passwordHead_error.addClass('text-danger fw-bold');
                    process = false;
                }

                if (password !== Confirmpassword) {
                    Confirmpassword_error.text('Passwords do not match.');
                    process = false;
                }
                if (!process) {
                    return;
                }
                const url = `https://erp.monstersmokewholesale.com/api/ecommerce/customer/resetPassword?email=${email}&token=${token}`;
                const data = {
                    password: password,
                    confirmPassword: Confirmpassword
                };

                fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
                })
                .then(response => {
                    if (response.status === 204) {
                        Toast.fire({
                            icon: 'success',
                            title: 'Password reset successfully.'
                        });

                        setTimeout(() => {
                            window.location.href = '/sign-in';
                        }, 1500); // Redirect after 1.5 seconds
                    }
                })
                .catch(error => {
                    alert('Error:', error);
                });

            });

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
