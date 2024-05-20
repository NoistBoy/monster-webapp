@extends('layout-parshal.layout-parshal')

<script>
    document.addEventListener("DOMContentLoaded", function() {

    });

    async function updateCustomerAddress(data) {
        const cusId = "{{ Session::get('user.user_id') }}"; // Ensure cusId is properly formatted as a string
        const token = "{{ Session::get('user.accessToken') }}"; // Ensure token is properly formatted as a string

        const url = `https://erp.monstersmokewholesale.com/api/ecommerce/customer/${cusId}/address`;

        try {
            const response = await fetch(url, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json, text/plain',
                    'Referer': 'https://www.monstersmokewholesale.com/',
                    'User-Agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36',
                    'sec-ch-ua': '"Chromium";v="124", "Google Chrome";v="124", "Not-A.Brand";v="99"',
                    'sec-ch-ua-mobile': '?0',
                    'sec-ch-ua-platform': '"Windows"'
                },
                body: JSON.stringify(data)
            });

            if (!response.ok) {
                throw new Error('Network response was not ok');
            }

            return await response.json();
        } catch (error) {
            console.error('Error updating customer address:', error);
            throw error;
        }
    }


    async function getCountries() {
        const url = 'https://erp.monstersmokewholesale.com/api/country/all';

        try {
            const response = await fetch(url);
            const responseData = await response.json();

            if (responseData.status === 200) {
                return responseData.result;
            } else {
                throw new Error("Something went wrong!");
            }
        } catch (error) {
            console.error("Error fetching countries:", error);
            throw error;
        }
    }

    async function getStates(countryId, setDefault = true) {
        const url = `https://erp.monstersmokewholesale.com/api/country/${countryId}/allState`;

        try {
            const response = await fetch(url);
            const responseData = await response.json();

            return responseData;

        } catch (error) {
            console.error("Error fetching states:", error);
            throw error;
        }
    }


</script>

@section('custom-style')
    @include('dashboardStyle')
@endsection

@section('content')
    <div class="container-fluid p-5 my-5"  style="overflow: hidden;">
        <div class="row d-flex justify-content-center" style="border-radius: 20px;  " >
            @include('user-dashboard-sidebar')
            <div class="col-md-10 col-12 mainContent-wrapper d-flex justify-content-center flex-column">
                <div class="container shadow mb-4">
                    <div class="row mt-4">
                        <div class="col-lg-12">
                        <div class="">

                            <div class="col-12 mb-3">
                                <div class="d-flex justify-content-start align-items-center gap-3 fs-4 fw-bold">
                                    <span style="cursor: pointer;" class="d-none-sm" id="ToggleSideBar"><i class="fa-solid fa-angles-left" id="dashboard-icon"></i></span>
                                    <span>Address List</span>
                                </div>
                            </div>

                            <div class="card-body mb-3 text-center d-flex justify-content-between align-items-center">
                                <p class="fs-dynamic fw-bold mb-0">Address Book Management</p>
                                <button class="btn-address fs-dynamic" id="user-addAddress">
                                    Add Address
                                </button>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>
                <div class="row" >
                    {{--  --}}
                         @include('dashboard-off-canvas')
                    {{--  --}}
                    {{-- User  --}}
                        {{-- <section >
                            <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12">
                                <div class="shadow mb-4 py-3" style="border-radius: 20px; background:#FFFFFF;">
                                    <div class="card-body text-center d-flex justify-content-between align-items-center px-dynamic">
                                        <p class="fs-dynamic fw-bold mb-0">Address Book Management</p>

                                        <button class="btn-address fs-dynamic" id="user-addAddress">
                                            Add Address
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </div>
                        </section> --}}
                    {{-- User  --}}
                    {{-- User  --}}
                        <section  >
                            <div class="container-fluid" style="  display: grid;  grid-template-columns: repeat(auto-fit, minmax(414px, 1fr)); gap: 20px;">
                                <!-- Single Info Card -->

                                @foreach ($customerAddresslist as $index => $customerAddresslist)
                                    <div class="me-auto col-sm-12 mb-3 px-4 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; cursor:pointer; background:#FFFFFF;">
                                        <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                            <span>
                                                <i class="fa-solid fa-house fs-1 fw-bold"></i>
                                            </span>
                                        </div>
                                        <div class=" d-flex flex-column w-100">
                                            <div class="d-flex justify-content-between">
                                                <span class="fw-bold">Address List {{ $index+1 }}</span>
                                                <a  href="javascript:showUpdateAddressForm({{ $customerAddresslist['id'] }})"  class="fw-bold" style="cursor: pointer;" > <i class="fa-solid fs-4 text-success fa-pen-to-square"></i></a>
                                            </div>
                                            <hr>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['address1'] }}</span>
                                            {{-- <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['address2'] }}</span> --}}
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['city'] }}</span>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['country'] }}</span>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['state'] }}</span>
                                            <span class="fw-bold mb-2" style="font-size: 1rem;"  >{{ $customerAddresslist['phone'] }}</span>
                                            <div class="d-flex justify-content-between align-items-center color-primary-red">
                                                @if (isset($customerAddresslist['defaultShippingAddress']))
                                                    @if ($customerAddresslist['defaultShippingAddress'])
                                                        <span class="fw-bold mb-2" style="font-size: 1rem;"  >Default shipping address</span>
                                                    @endif
                                                @endif

                                                @if (isset($customerAddresslist['defaultBillingAddress']))
                                                    @if ($customerAddresslist['defaultBillingAddress'])
                                                        <span class="fw-bold mb-2" style="font-size: 1rem;"  >Default billing address</span>
                                                    @endif
                                                @endif
                                                {{--  --}}
                                                @if (isset($customerAddresslist['shippingAddress']))
                                                    @if ($customerAddresslist['shippingAddress'])
                                                        <span class="fw-bold mb-2" style="font-size: 1rem;"  >Default shipping address</span>
                                                    @endif
                                                @endif

                                                @if (isset($customerAddresslist['billingAddress']))
                                                    @if ($customerAddresslist['billingAddress'])
                                                        <span class="fw-bold mb-2" style="font-size: 1rem;"  >Default billing address</span>
                                                    @endif
                                                @endif
                                            </div>
                                            <input type="hidden" id="addressId-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['id'] }}">
                                            <input type="hidden" id="address1-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['address1'] }}">
                                            <input type="hidden" id="address2-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['address2'] }}">
                                            <input type="hidden" id="city-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['city'] }}">
                                            <input type="hidden" id="stateId-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['stateId'] }}">
                                            <input type="hidden" id="state-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['state'] }}">
                                            <input type="hidden" id="countryId-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['countryId'] }}">
                                            <input type="hidden" id="county-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['county'] }}">
                                            <input type="hidden" id="zip-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['zip'] }}">
                                            <input type="hidden" id="phone-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['phone'] }}">
                                            @if (isset($customerAddresslist['defaultBillingAddress']))
                                                <input type="hidden" id="defaultBillingAddress-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['defaultBillingAddress'] }}">
                                            @endif

                                            @if (isset($customerAddresslist['defaultShippingAddress']))
                                                <input type="hidden" id="defaultShippingAddress-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['defaultShippingAddress'] }}">
                                            @endif
                                            {{--  --}}
                                            @if (isset($customerAddresslist['billingAddress']))
                                                <input type="hidden" id="defaultBillingAddress-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['billingAddress'] }}">
                                            @endif

                                            @if (isset($customerAddresslist['shippingAddress']))
                                                <input type="hidden" id="defaultShippingAddress-of-{{ $customerAddresslist['id'] }}" value="{{ $customerAddresslist['shippingAddress'] }}">
                                            @endif
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
                                <div class="modal-body" id="details-views" style="height: auto;">
                                    <div class="row my-4 px-3" id="add-customer-address" >
                                        <div class="col-12 mb-3">
                                            <h3>Add Billing Address</h3>
                                        </div>
                                        <div class="col-md-12 col-sm-12 mb-3 ">
                                            <input type="text" name="address1" value="" class="form-control form-control-lg reset" id="customer-address1" placeholder="Address 1 *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="address1_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <input type="text" name="address2" value="" class="form-control form-control-lg reset" id="customer-address2" placeholder="Address 2">
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
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
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <select  name="state_id" id="state_id" class="form-select form-select-lg reset" disabled></select>
                                            <small class="text-danger fw-bold px-2 error-message"  id="state_id_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <input type="text" name="city" value="" class="form-control form-control-lg reset" id="customer-city" placeholder="City *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="city_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <input type="text" name="postalCode" class="form-control form-control-lg reset" id="customer-postalCode" placeholder="Zip/Postal Code *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="postalCode_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <input type="text" name="phone" id="customer-phone" class="form-control form-control-lg reset"  placeholder="Phone *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="phone_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3">
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
                        <!-- The Modal -->
                        <div id="update-address-modal" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close" id="close-update-address-modal">&times;</span>

                                </div>
                                <div class="modal-body" id="details-views" >
                                    <div class="row my-4 px-3" id="add-customer-address" >
                                        <div class="col-12 mb-3">
                                            <h3>Add Billing Address</h3>
                                        </div>
                                        <div class="col-12 mb-3 ">
                                            <label for="" class="fw-bold px-1">Address 1 <span class="text-danger">*</span></label>
                                            <input type="text" name="updateaddress1" value="" class="form-control form-control-lg reset" id="customer-updateaddress1" placeholder="Address 1 *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="updateaddress1_error" ></small>
                                            <input type="hidden" name="updateaddressid" value="" class="form-control form-control-lg reset" id="updateaddressid">
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <label for="" class="fw-bold px-1">Address 2</label>
                                            <input type="text" name="updateaddress2" value="" class="form-control form-control-lg reset" id="customer-updateaddress2" placeholder="Address 2">
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <label for="" class="fw-bold px-1">Country <span class="text-danger">*</span></label>
                                            <select name="updatecountry_id" id="updatecountry_id" class="form-select form-select-lg reset" required>

                                            </select>
                                            <small class="text-danger fw-bold px-2 error-message"  id="updatecountry_id_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <label for="" class="fw-bold px-1">State <span class="text-danger">*</span></label>
                                            <select  name="updatestate_id" id="updatestate_id" class="form-select form-select-lg reset" ></select>
                                            <small class="text-danger fw-bold px-2 error-message"  id="updatestate_id_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <label for="" class="fw-bold px-1">City <span class="text-danger">*</span></label>
                                            <input type="text" name="updatecity" value="" class="form-control form-control-lg reset" id="customer-updatecity" placeholder="City *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="updatecity_error" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <label for="" class="fw-bold px-1">Zip/PostalCode <span class="text-danger">*</span></label>
                                            <input type="text" name="updatepostalCode" class="form-control form-control-lg reset" id="customer-updatepostalCode" placeholder="Zip/Postal Code *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="customer-updatepostalCode" ></small>
                                        </div>
                                        <div class="col-md-4 col-sm-12 mb-3 ">
                                            <label for="" class="fw-bold px-1">Phone</label>
                                            <input type="text" name="updatephone" id="customer-updatephone" class="form-control form-control-lg reset"  placeholder="Phone *">
                                            <small class="text-danger fw-bold px-2 error-message"  id="updatephone_error" ></small>
                                        </div>
                                        <div class="col-12 mb-3 ">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12 d-flex align-items-center gap-4">
                                                    <label for="default-billing-address"  class="fw-bold px-1">Default Billing Address</label>
                                                    <input type="checkbox" name="default-billing-address" id="default-billing-address" style="width: 20px; height: 20px;">
                                                </div>
                                                <div class="col-md-6 col-sm-12 d-flex align-items-center gap-4">
                                                    <label for="default-shipping-address"  class="fw-bold px-1">Default Shipping Address</label>
                                                    <input type="checkbox" name="default-shipping-address" id="default-shipping-address" style="width: 20px; height: 20px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-4 my-auto">
                                            <button class="btn bg-monster-primary" id="call-update-customer-address"  style="border-radius: 10px !important;" >Update&nbsp;Address</button>
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

$('#call-update-customer-address').click(function (e) {
    e.preventDefault();
    var process = true;


    if ($('#customer-updateaddress1').val() === '') {
        $('#updateaddress1_error').html("Address1 is required!");
        process = false;
    }

    if ($('#updatecountry_id').val() === '') {
        $('#updatecountry_id_error').html("Country is required!");
        process = false;
    }

    if ($('#updatestate_id').val() === '') {
        $('#updatestate_id_error').html("State is required!");
        process = false;
    }

    if ($('#customer-updatecity').val() === '') {
        $('#updatecity_error').html("City is required!");
        process = false;
    }

    if ($('#customer-updatepostalCode').val() === '') {
        $('#updatepostalCode_error').html("Zip/PostalCode is required!");
        process = false;
    }

    if (process) {

        const data = {
            customerId: 0,
            id: $('#updateaddressid').val(),
            address1: $('#customer-updateaddress1').val(),
            address2: $('#customer-updateaddress2').val(),
            city: $('#customer-updatecity').val(),
            county: $('#updatecountry_id option:selected').text(),
            stateId: $('#updatestate_id').val(),
            state: $('#updatestate_id option:selected').text(),
            countryId: $('#updatecountry_id').val(),
            country: $('#updatecountry_id option:selected').text(),
            zip: $('#customer-updatepostalCode').val(),
            phone: $('#customer-updatephone').val(),
            defaultBillingAddress: $('#default-billing-address').prop('checked'),
            defaultShippingAddress: $('#default-shipping-address').prop('checked'),
            billingAddress: $('#default-billing-address').prop('checked'),
            shippingAddress: $('#default-shipping-address').prop('checked'),
            active: true
        };

        console.log('Data:', data);

        // Call the updateCustomerAddress function with the data object
        updateCustomerAddress(data)
            .then(response => {
                Toast.fire({
                    icon: 'success',
                    title: 'Address updated successfully!'
                });
                setTimeout(function() {
                    window.location.reload();
                }, 300);
                console.log('Customer address updated successfully:', response);
            })
            .catch(error => {
                alert('Error updating customer address:', error);
            });
    }
});


    function showUpdateAddressForm(addressId){
        var countriesOption = ``;
        getCountries()
        .then(countries => {
            countries.forEach(country => {
                countriesOption += `<option value="${country.id}" ${country.id == $('#countryId-of-'+addressId).val() ? 'selected' : ''} >${country.name}</option>`;

            });
            $('#updatecountry_id').html(countriesOption);

        })
        .catch(error => {
            alert('Error fetching countries:', error);
        });

        $('#updatecountry_id').change(function () {

            getStates( $(this).val())
            .then(states => {
                // console.log('States:', states);

                let statesoptions = "<option value=''> ---- Please Select ----</option>";
                if (states.status === 200) {
                    states.result.forEach(city => {
                        statesoptions += `<option value='${city.id}'  >${city.name}</option>`;
                    });

                    $('#updatestate_id').html(statesoptions);
                } else {
                    throw new Error("Something went wrong!");
                }

            })
            .catch(error => {
                alert('Error fetching states:', error);
            });


        });

        getStates( $('#countryId-of-'+addressId).val())
            .then(states => {
                // console.log('States:', states);

                let statesoptions = "<option value=''> ---- Please Select ----</option>";
                if (states.status === 200) {
                    states.result.forEach(city => {
                        statesoptions += `<option value='${city.id}' ${city.id == $('#stateId-of-'+addressId).val() ? 'selected' : ''} >${city.name}</option>`;
                    });

                    $('#updatestate_id').html(statesoptions);
                } else {
                    throw new Error("Something went wrong!");
                }

            })
            .catch(error => {
                alert('Error fetching states:', error);
            });


        $('#updateaddressid').val(addressId);
        $('#customer-updateaddress1').val($('#address1-of-'+addressId).val());
        $('#customer-updateaddress2').val($('#address2-of-'+addressId).val());


        $('#customer-updatecity').val($('#city-of-'+addressId).val());
        $('#customer-updatepostalCode').val($('#zip-of-'+addressId).val());
        $('#customer-updatephone').val($('#phone-of-'+addressId).val());


        if ($('#defaultBillingAddress-of-'+addressId).val() == 1) {
            $('#default-billing-address').prop('checked', true);
        }
        else{
            $('#default-billing-address').prop('checked', false);
        }
        if ($('#defaultShippingAddress-of-'+addressId).val() == 1) {
            $('#default-shipping-address').prop('checked', true);
        }
        else{
            $('#default-shipping-address').prop('checked', false);
        }
        var updateAddressmodal = document.getElementById("update-address-modal");
        var closeUpdateAddressModal = document.getElementById("close-update-address-modal");
        updateAddressmodal.style.display = "block";

        closeUpdateAddressModal.onclick = function() {
            updateAddressmodal.style.display = "none";
        }

    }

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
                        $('#update-address-modal').hide();
                        // $('#add-customer-address').css('display', 'none');
                        // $('#Shiping-Address').append(`<option value="${response.result.id}" selected >${response.result.address1}</option>`)
                        Toast.fire({
                            icon: "success",
                            title: `Address add Successfully!`
                        });
                        setTimeout(function() {
                            window.location.reload();
                        }, 100);

                    }else{
                        Toast.fire({
                            icon: "error",
                            title: `Some unexpected situations found.`
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
