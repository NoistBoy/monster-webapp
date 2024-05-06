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
                            <span>Address List</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-5" style="margin-left: 2rem;">

                    {{-- User  --}}
                        <section >
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="shadow mb-4 py-3" style="border-radius: 20px;">
                                    <div class="card-body text-center d-flex justify-content-between align-items-center px-5">
                                        <p class="fs-3 fw-bold mb-0">Address Book Management</p>

                                        <button class="btn-address" id="user-addAddress">
                                            Add Address
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </section>
                    {{-- User  --}}
                    {{-- User  --}}
                        <section >
                            <div class="container-fluid" style="  display: grid;  grid-template-columns: repeat(auto-fit, minmax(414px, 1fr)); gap: 20px;">
                                <!-- Single Info Card -->
                                @foreach ($customerAddresslist as $index => $customerAddresslist)
                                    <div class="me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; cursor:pointer;">
                                        <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                            <span>
                                                <i class="fa-solid fa-house fs-1 fw-bold"></i>
                                            </span>
                                        </div>
                                        <div class=" d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-bold">Address List {{ $index+1 }}</span>
                                                <span class="fw-bold" style="cursor: pointer;"><i class="fa-solid fa-pencil text-success"></i></span>
                                            </div>
                                            <hr>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['address1'] }}</span>
                                            {{-- <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['address2'] }}</span> --}}
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['city'] }}</span>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['country'] }}</span>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['state'] }}</span>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['phone'] }}</span>
                                            <div class="d-flex justify-content-between align-items-center color-primary-red">
                                                @if ($customerAddresslist['defaultShippingAddress'])
                                                    <span class="fw-bold mb-2" style="font-size: 1rem;"  >Default shipping address</span>
                                                @endif
                                                @if ($customerAddresslist['defaultBillingAddress'])
                                                    <span class="fw-bold mb-2" style="font-size: 1rem;"  >Default billing address</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <!-- Single Info Card End-->
                            </div>
                        </section>
                    {{-- User  --}}
                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close" id="close-model">&times;</span>

                                </div>
                                <div class="modal-body" id="details-views" style="height: 26rem;">
                                    <div class="row my-4 px-3" id="add-customer-address" >
                                        <div class="col-12 mb-3">
                                            <h3>Add Billing Address</h3>
                                        </div>
                                        <div class="col-12 mb-3 ">
                                            <input type="text" name="address1" value="" class="form-control form-control-lg reset" id="customer-address1" placeholder="Address 1 *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="address1_error" ></small>
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
                                            <small class="text-danger fw-bold px-2 error-message"  id="country_error" ></small>
                                        </div>
                                        <div class="col-4 mb-3 ">
                                            <select  name="state_id" id="state_id" class="form-select form-select-lg reset" disabled></select>
                                            <small class="text-danger fw-bold px-2 error-message"  id="state_id_error" ></small>
                                        </div>
                                        <div class="col-4 mb-3 ">
                                            <input type="text" name="city" value="" class="form-control form-control-lg reset" id="customer-city" placeholder="City *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="city_error" ></small>
                                        </div>
                                        <div class="col-4 mb-3 ">
                                            <input type="text" name="postalCode" class="form-control form-control-lg reset" id="customer-postalCode" placeholder="Zip/Postal Code *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="postalCode_error" ></small>
                                        </div>
                                        <div class="col-4 mb-3 ">
                                            <input type="text" name="phone" id="customer-phone" class="form-control form-control-lg reset"  placeholder="Phone *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="phone_error" ></small>
                                        </div>
                                        <div class="col-4 mb-3">
                                            <button class="btn bg-monster-primary" id="add-new-address" onclick="addCustomerAddress();" >Add Address</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="modal-footer">
                                    <h3>Modal Footer</h3>
                                </div> --}}
                            </div>

                        </div>
                        {{--  --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')

<script>
    var token = @php echo json_encode(Session::get('user.accessToken')); @endphp;
    var modal = document.getElementById("myModal");
    var btn = document.getElementById("user-addAddress");
    var span = document.getElementsByClassName("close")[0];


    btn.onclick = function() {
      modal.style.display = "block";
    }
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

    function addCustomerAddress() {

            // $('.action-button').prop('disabled', true);

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
                    // $('.action-button').prop('disabled', false);

                    if(!response.hasError){
                        $('.reset').val("");
                        // $('#add-customer-address').css('display', 'none');
                        // $('#Shiping-Address').append(`<option value="${response.result.id}" selected >${response.result.address1}</option>`)
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
                if (xhr.status == 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    var errors = xhr.responseJSON.errors;
                    $('.error-message').text('');

                    $.each(errors, function (field, fieldErrors) {
                        $('#' + field + '_error').text(fieldErrors[0]);
                    });
                } else {

                    console.log("The status " + status);
                    console.log("The Message " + error);
                }

                }
            });
        }

</script>
@endsection
