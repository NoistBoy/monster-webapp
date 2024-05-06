@extends('layout-parshal.layout-parshal')



@section('custom-style')
@include('dashboardStyle')
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
                            <span>My Profile</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-5" style="margin-left: 2rem;">

                    {{-- User Profile Start --}}
                    <section >
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="shadow mb-4 py-3" style="border-radius: 20px;">
                                <div class="card-body text-center">
                                  <img src="{{ Session::get('user.imageUrl') ?? asset('asset/img/user-dummy.jpeg') }}" alt="avatar"
                                    class="rounded-circle img-fluid" style="width: 150px; outline: 6px solid #4056500f;">
                                  <h5 class="my-3 fw-bold">{{ Session::get('user.firstName') }}</h5>
                                  <p class="text-muted mb-2 fw-bold text-secondary"><i class="fa-solid fa-envelope  text-primary"></i>&nbsp;{{ Session::get('user.email') }}</p>
                                  <p class="text-muted mb-2 fw-bold text-secondary"><i class="fa-solid fa-phone text-success"></i>&nbsp;{{ Session::get('user.phone') }}</p>
                                  {{-- <div class="d-flex justify-content-center mb-2">
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary">Follow</button>
                                    <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-outline-primary ms-1">Message</button>
                                  </div> --}}
                                </div>
                              </div>
                            </div>
                            <div class="col-lg-8">
                              <div class="shadow mb-4 py-4 px-3" style="border-radius: 20px;" >
                                <div class="card-body">
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">First Name <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg"  value="{{ Session::get('user.firstName') }}">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Last Name <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg"  value="{{ Session::get('user.lastName') }}">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Email <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg"  value="{{ Session::get('user.email') }}">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Phone <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control form-control-lg"  value="{{ Session::get('user.phone') }}">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Company Name <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg"  value="{{ Session::get('user.company') }}">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Tax Id <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control form-control-lg"  value="{{ Session::get('user.taxId') }}">
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">&nbsp;</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <button class="btn product-card-btn" >Update</button>
                                    </div>
                                  </div>

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
    var token = @php echo json_encode(Session::get('user.accessToken')); @endphp;
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("myBtn");
    var span = document.getElementsByClassName("close")[0];


    span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
</script>

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
@endsection
