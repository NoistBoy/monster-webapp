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
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        transition: 0.2s;
    }

</style>
@endsection

@section('content')
    <div class="container-fluid p-5 my-5">
        <div class="row py-5 px-3 shadow" style="border-radius: 20px;">
            @include('user-dashboard-sidebar')
            <div class="col-md-10 col-12 mainContent-wrapper">
                <div class="row" style="margin-left: 2rem;">
                    <div class="col-12">
                        <div class="d-flex gap-3 fs-4 fw-bold">
                            <span style="cursor: pointer;" id="ToggleSideBar"><i class="fa-solid fa-angles-left" id="dashboard-icon"></i></span>
                            <span>Forgot Password</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-5" style="margin-left: 2rem;">

                    {{-- User Profile Start --}}
                    <section >
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-12">
                              <div class="shadow mb-4 py-4 px-3" style="border-radius: 20px;" >
                                <div class="card-body">

                                    {{--  --}}

                                        <div class="tab">
                                            <button class="tablinks  mx-3 active" onclick="openCity(event, 'forgot-password')" id="forgot-password-btn">Forget Password</button>
                                            <button class="tablinks mx-3" onclick="openCity(event, 'change-password')">Change Password</button>
                                        </div>
                                        <hr>

                                        <div id="forgot-password" class="tabcontent mt-4">
                                            <div class="mb-4">
                                                <h3 class="mb-1">Forgot Password</h3>
                                                <p class="text-danger fw-bold" >Fields are required with *</p>
                                            </div>

                                            <div>
                                                <form action="" id="forgot-password-form" >
                                                    <div class="row form-group mb-3">
                                                        <div class="col-2 form-label fw-bold">Email<span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-8">
                                                            <input type="email" name="email" class="form-control form-control-lg">
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-2 form-label fw-bold"></div>
                                                        <div class="col-8">
                                                            <button class="btn-address" >
                                                                Send
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        <div id="change-password" class="tabcontent mt-4" >
                                            <div class="mb-4">
                                                <h3 class="mb-1">Update Your Password</h3>
                                                <p class="text-danger fw-bold" >Fields are required with *</p>
                                            </div>
                                            <div>
                                                <form action="" id="change-password-form" >
                                                    <div class="row form-group mb-3">
                                                        <div class="col-2 form-label fw-bold">Old Password <span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-8 input-field">
                                                            <input type="password" name="old-password" id="old-password" class="form-control form-control-lg">
                                                            <i  data-passId="old-password" class="fa-regular fa-eye showPassword"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-2 form-label fw-bold">New Password <span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-8 input-field">
                                                            <input type="password" name="new-password" id="new-password" class="form-control form-control-lg">
                                                            <i  data-passId="new-password" class="fa-regular fa-eye showPassword"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-2 form-label fw-bold">Confirm Your Password <span class="text-danger fw-bold">*</span></div>
                                                        <div class="col-8 input-field">
                                                            <input type="password" name="confirm-password" id="confirm-password" class="form-control form-control-lg">
                                                            <i  data-passId="confirm-password" class="fa-regular fa-eye showPassword"></i>
                                                        </div>
                                                    </div>
                                                    <div class="row row form-group mb-3">
                                                        <div class="col-2 form-label fw-bold"></div>
                                                        <div class="col-8">
                                                            <button class="btn-address" >
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
        $("#forgot-password-btn").click();

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

        function openCity(evt, cityName) {
            $(".tabcontent").hide();
            $(".tablinks").removeClass("active");
            $("#" + cityName).show();
            $(evt.currentTarget).addClass("active");
        }
    </script>
@endsection
