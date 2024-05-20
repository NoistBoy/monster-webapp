@extends('layout-parshal.layout-parshal')



@section('custom-style')
@include('dashboardStyle')
<style>

    /* Style the tab */
    .tab {
    overflow: hidden;
    /* border: 1px solid #ccc;
    background-color: #f1f1f1; */
    }

    /* Style the buttons inside the tab */
    .tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
    background-color: #ddd;
    }

    /* Create an active/current tablink class */
    .tab button.active {
    background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
    display: none;
    padding: 6px 12px;
    /* border: 1px solid #ccc;
    border-top: none; */
    }

    .input-field  {
        position: relative;
    }
    .input-field i {
        position: absolute;
        color: var(--text-color);
        padding: 10px;
        right: 25px;
        top: 26px;
        transform: translateY(-50%);
        cursor: pointer;
        transition: 0.2s;
    }

</style>
@endsection

@section('content')
<div class="container-fluid p-dynamic " style="overflow: hidden;">
    <div class="row py-5 px-3  section-wrapper-dashboard" style="border-radius: 20px;">
            @include('user-dashboard-sidebar')
            <div class="col-md-10 col-12 mainContent-wrapper">
                {{-- <div class="row " >
                    <div class="col-12">
                        <div class="d-flex gap-3 fs-4 fw-bold container">
                            <span style="cursor: pointer;" class="d-none-sm" id="ToggleSideBar"><i class="fa-solid fa-angles-left" id="dashboard-icon"></i></span>
                            <span>Change Password</span>
                        </div>
                    </div>
                </div> --}}
                <div class="row" >

                    {{--  --}}
                        @include('dashboard-off-canvas')
                    {{--  --}}
                    {{-- User Profile Start --}}
                    <section >
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12">
                              <div class="container shadow py-4 px-4" style="border-radius: 20px;" >
                                <div class="card-body">

                                    {{--  --}}

                                        <div class="tab d-small-flex">
                                            {{-- <button class="tablinks  mx-3 active" onclick="openCity(event, 'forgot-password')" id="forgot-password-btn">Forget Password</button> --}}
                                            {{-- <button class="tablinks mx-3" onclick="openCity(event, 'change-password')" id="change-password-btn" >Change Password</button> --}}
                                            <div class="d-flex gap-3 mb-3 fs-4 fw-bold">
                                                <span style="cursor: pointer;" class="d-none-sm" id="ToggleSideBar"><i class="fa-solid fa-angles-left" id="dashboard-icon"></i></span>
                                                <span>Change Password</span>
                                            </div>

                                        </div>
                                        {{-- <hr> --}}

                                        {{-- <div id="forgot-password" class="tabcontent mt-4">
                                            <div class="mb-4">
                                                <h3 class="mb-1">Forgot Password</h3>
                                                <p class="text-danger fw-bold" >Fields are required with *</p>
                                            </div>

                                            <div>
                                                <form action="" id="forgot-password-form" >
                                                    <div class="row form-group mb-3">
                                                        <div class="col-md-2 col-sm-12 form-label fw-bold">Email<span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-md-8 col-sm-12">
                                                            <input type="email" name="email" class="form-control form-control-lg">
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-md-2 col-sm-12 form-label fw-bold"></div>
                                                        <div class="col-md-8 col-sm-12">
                                                            <button class="btn-address w-100" >
                                                                Send
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div> --}}

                                        <div id="change-password" class=" mt-4" >
                                            <div class="mb-5">
                                                <h3 class="mb-1">Update Your Password</h3>
                                                <p class="text-danger fw-bold" >Fields are required with *</p>
                                            </div>
                                            <div>
                                                <form action="" id="change-password-form" >
                                                    <div class="row form-group mb-3">
                                                        <div class="col-md-2 col-sm-12 form-label fw-bold">Old Password <span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-md-10 col-sm-12 input-field">
                                                            <input type="password" name="old-password" id="old-password" class="form-control form-control-lg">
                                                            <i  data-passId="old-password" class="fa-regular fa-eye showPassword"></i>
                                                            <small class="text-danger fw-bold error-message" id="old-password_error" ></small>
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-md-2 col-sm-12 form-label fw-bold">New Password <span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-md-10 col-sm-12 input-field">
                                                            <input type="password" name="new-password" id="new-password" class="form-control form-control-lg">
                                                            <i  data-passId="new-password" class="fa-regular fa-eye showPassword"></i>
                                                            <small class="text-danger fw-bold error-message" id="new-password_error" ></small>
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-md-2 col-sm-12 form-label fw-bold">Confirm Your Password <span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-md-10 col-sm-12 input-field">
                                                            <input type="password" name="confirm-password" id="confirm-password" class="form-control form-control-lg">
                                                            <i  data-passId="confirm-password" class="fa-regular fa-eye showPassword"></i>
                                                            <small class="text-danger fw-bold error-message" id="confirm-password_error" ></small>
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-md-2 col-sm-12 form-label fw-bold"></div>
                                                        <div class="col-md-10 col-sm-12">
                                                            <button class="btn-address w-100" id="change-user-password" >
                                                                Change Password
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    {{--  --}}

                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </section>
                    {{-- User Profile End --}}

                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')


<script>
    $(document).ready(function() {
        $('#ToggleSideBar').click(function() {
            $('.sideBar-wrapper').toggleClass('sidebar-open');
            $('.mainContent-wrapper').toggleClass('col-md-12');
            if($('#dashboard-icon').hasClass('fa-angles-left')){
                $('#dashboard-icon').removeClass('fa-angles-left');
                $('#dashboard-icon').addClass('fa-angles-right');
            }else{
                $('#dashboard-icon').removeClass('fa-angles-right');
                $('#dashboard-icon').addClass('fa-angles-left');
            }

        });
    });

</script>

<script>

    $(document).ready(function() { // open default tab
        $("#change-password-btn").click();

        $('.showPassword').click(function() {
            passId = $(this).data('passid');

            let pass = $('#'+passId);
            let icon = $(this);
            togglePasswordVisibility(pass, icon);
        });

        $('#change-user-password').click(function (e) {
            e.preventDefault();
            $('.error-message').html("");
            var process = true;
            const oldPassword = $('#old-password').val();
            const newPassword = $('#new-password').val();
            const confirmPassword = $('#confirm-password').val();

            if (oldPassword == '' || oldPassword == null ) {
                process = false;
                $('#old-password_error').html('Old password is required!');
            }
            if (newPassword == '' || newPassword == null) {
                process = false;
                $('#new-password_error').html('New password is required!');
            }
            if (confirmPassword == '' || confirmPassword == null) {
                process = false;
                $('#confirm-password_error').html('Comfirm password is required!');
            }

            if (process) {
                const token = "{{ Session::get('user.accessToken') }}";
                changePassword(oldPassword, newPassword, confirmPassword, token);
            }

        });

    });

        function togglePasswordVisibility(pass, icon) {
            pass.attr('type', pass.attr('type') === 'password' ? 'text' : 'password');
            icon.toggleClass('fa-eye fa-eye-slash');
        }

        function openCity(evt, cityName) {

            $(".tabcontent").hide();
            $(".tablinks").removeClass("active");
            $("#" + cityName).show();
            $(evt.currentTarget).addClass("active");

        }

        function changePassword(oldPassword, newPassword, confirmPassword, token) {
            const url = 'https://erp.monstersmokewholesale.com/api/ecommerce/customer/changePassword';

            const requestOptions = {
                method: 'POST',
                headers: {
                    'Accept': 'application/json, text/plain',
                    'Accept-Language': 'en-US,en;q=0.9',
                    'Authorization': `Bearer ${token}`,
                    'Content-Type': 'application/json',
                    'Origin': 'https://www.monstersmokewholesale.com',
                    'Referer': 'https://www.monstersmokewholesale.com/',
                    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                    'sec-ch-ua': '"Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
                    'sec-ch-ua-mobile': '?0',
                    'sec-ch-ua-platform': '"Windows"'
                },
                body: JSON.stringify({
                    oldPassword: oldPassword,
                    password: newPassword,
                    confirmPassword: confirmPassword
                })
            };

            fetch(url, requestOptions)
                .then(response => {

                    if (response.status === 204) {
                        return null;
                    }

                    if (!response.ok) {
                        throw new Error('Network response was not ok ' + response.statusText);
                    }

                    return response.json();
                })
                .then(data => {
                    alert("Password change successfullly");
                    window.location.href = '/log-out';
                })
                .catch(error => {
                    alert('There was an error!', error);
                });
            }


    </script>
@endsection
