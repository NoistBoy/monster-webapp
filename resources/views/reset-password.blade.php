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
                            <h2 class="fw-bold">FORGOT PASSWORD</h2>
                            <p class="text-secondary  mb-5">Please enter your email address below to receive a password reset link.</p>
                            <form  id="forgotPassword-form" >
                                <!-- 2 column grid layout with text inputs for the first and last names -->

                                <!-- User Name -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <label for=""  class="fw-bold" style="float: left;" >Email <span class="text-danger fw-bold">*</span></label>
                                    &nbsp;&nbsp;<small id="forgotPassword_error" style="float: left;"  class="error-message text-danger fw-bold "></small>
                                        <input type="text" name="user-email" class="form-control reset form-control-lg reset" id="user-email" required>

                                </div>
                                <!-- Submit button -->
                                <button class="btn mb-2 auth-form-btn w-100" id="submi-email"  >Submit</button>
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
            $('#submi-email').click(function (e) {
                e.preventDefault();
                debugger
                const email = $('#user-email').val();
                if(email != '' && email != null){

                    sendForgotPasswordEmail(email)
                    .then(data => {
                        // console.log(data);

                        Toast.fire({
                            icon: `success`,
                            title: `Link has been send to you email.`
                        });

                        $('.reset').val(null);
                    })
                    .catch(error => {

                        alert('Error:', error);
                    });

                }


            });
        });

        function sendForgotPasswordEmail(email) {
            // Define the request options
            const requestOptions = {
                method: 'POST',
                headers: {
                'Content-Type': 'application/json'
                }
            };

            // Perform the fetch request
            return fetch('https://erp.monstersmokewholesale.com/api/ecommerce/customer/sendForgotPasswordEmail?email=' + encodeURIComponent(email), requestOptions)
                .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to send forgot password email');
                }
                // Check if response has content
                if (response.status === 204) {
                    return { message: 'No content' };
                }
                return response.json();
                })
                .then(data => {

                    return data;
                })
                .catch(error => {

                    alert('Error:', error);
                    throw error;
                });
            }

    </script>
@endsection
