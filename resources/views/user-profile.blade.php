@extends('layout-parshal.layout-parshal')

<script>
    async function updateCustomer(data) {

        const cusId = "{{ Session::get('user.user_id') }}";
        const token = "{{ Session::get('user.accessToken') }}";
        const url = 'https://erp.monstersmokewholesale.com/api/ecommerce/customer';

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
            alert('Error updating customer:', error);
            throw error;
        }
    }
</script>

@section('custom-style')
    @include('dashboardStyle')
<style>

    .update-user-detail:focus-visible{
        background: #3c3b6e !important;
    }
</style>
@endsection

@section('content')
<div class="container-fluid p-dynamic " style="overflow: hidden;">
    <div class="row py-5 px-3  section-wrapper-dashboard" style="border-radius: 20px;">
            @include('user-dashboard-sidebar')
            <div class="col-md-10 col-12 mainContent-wrapper">
                <div class="container shadow ">
                    <div class="row margin-left-small-view mb-4 mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-start align-items-center gap-3 fs-4 fw-bold">
                            <span style="cursor: pointer;" class="d-none-sm" id="ToggleSideBar"><i class="fa-solid fa-angles-left" id="dashboard-icon"></i></span>
                            <span>My Profile</span>
                        </div>
                    </div>
                </div>
                @include('dashboard-off-canvas')
                <div class="row pt-5" >
                        {{--  --}}
                        {{--  --}}
                    {{-- User Profile Start --}}
                    <section >
                        <div class="container-fluid">
                          <div class="row">
                            <div class="col-lg-4">
                              <div class="user-info-card shadow mb-4 py-3" style="border-radius: 20px;">
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
                                        <input type="text" id="update-firstname" class="form-control form-control-lg"  value="{{ Session::get('user.firstName') }}">
                                        <small class="fw-bold text-danger error-message" id="firstname_error"></small>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Last Name <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="update-lastname" class="form-control form-control-lg"  value="{{ Session::get('user.lastName') }}">
                                        <small class="fw-bold text-danger error-message" id="lastname_error"></small>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Email <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="email" id="update-email" class="form-control form-control-lg"  value="{{ Session::get('user.email') }}">
                                        <small class="fw-bold text-danger error-message" id="email_error"></small>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Phone <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="number" id="update-phone" class="form-control form-control-lg"  value="{{ Session::get('user.phone') }}">
                                        <small class="fw-bold text-danger error-message" id="phone_error"></small>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Company Name <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="update-companyName" class="form-control form-control-lg"  value="{{ Session::get('user.company') }}">
                                        <small class="fw-bold text-danger error-message" id="companyName_error"></small>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                      <p class="mb-0 fw-bold ">Tax Id <span class="text-danger">*</span></p>
                                    </div>
                                    <div class="col-sm-9">
                                        <input type="text" id="update-taxIx" class="form-control form-control-lg"  value="{{ Session::get('user.taxId') }}">
                                        <small class="fw-bold text-danger error-message" id="taxIx_error"></small>
                                    </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                    <div class="col-sm-3">
                                        <p class="mb-0">&nbsp;</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <button class="btn product-card-btn" id="update-user-detail" >Update</button>
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

{{-- <script>
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
</script> --}}

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
        $(document).ready(function () {

        $('#update-user-detail').click(function (e) {
            e.preventDefault();
            $('.error-message').text("");
            var process = true;
            $('#update-firstname').val().trim() === '' ? ($('#firstname_error').text("First name is required!"), process = false) : '';
            $('#update-lastname').val().trim() === '' ? ($('#lastname_error').text("Last name is required!"), process = false) : '';
            $('#update-companyName').val().trim() === '' ? ($('#companyName_error').text("Company name is required!"), process = false) : '';
            $('#update-email').val().trim() === '' ? ($('#email_error').text("Email is required!"), process = false) : '';
            $('#update-phone').val().trim() === '' ? ($('#phone_error').text("Phone is required!"), process = false) : '';
            $('#update-taxIx').val().trim() === '' ? ($('#taxIx_error').text("Tax id is required!"), process = false) : '';
            if (!process) {
                return;
            }
            const data = {
                "customerDto": {
                    "id": {{ Session::get('user.user_id') }},
                    "updatedBy": null,
                    "updatedTimestamp": null,
                    "idStr": null,
                    "firstName": $('#update-firstname').val(),
                    "lastName": $('#update-lastname').val(),
                    "company": $('#update-companyName').val(),
                    "email": $('#update-email').val(),
                    "phone": $('#update-phone').val(),
                    "imageUrl": null,
                    "taxId": $('#update-taxIx').val(),
                    "active": {{ Session::get('user.active') }},
                    "verified": {{ Session::get('user.verified') }},
                    "tier": {{ Session::get('user.tier') }},
                    "createdBy": {{ Session::get('user.createdBy') ?? 'null' }},
                    "insertedTimestamp": {{ Session::get('user.insertedTimestamp') ?? 'null' }},
                    "parentCustomerId": {{ Session::get('user.parentCustomerId') ?? 'null' }},
                    "name": "{{ Session::get('user.name') ?? 'null'  }}",
                    "storeId": {{ Session::get('user.storeId') ?? 'null'  }},
                    "customerStoreName": {{ Session::get('user.customerStoreName') ?? 'null'  }},
                    "email1": {{ Session::get('user.email1') ?? 'null'  }},
                    "email2": {{ Session::get('user.email2') ?? 'null'  }},
                    "phone1": {{ Session::get('user.phone1') ?? 'null'  }},
                    "phone2": {{ Session::get('user.phone2') ?? 'null'  }},
                    "storePhone": {{ Session::get('user.storePhone') ?? 'null'  }},
                    "gender": {{ Session::get('user.gender') ?? 'null'  }},
                    "tierStr": {{ Session::get('user.tierStr') ?? 'null'  }},
                    "authUserLoginId": {{ Session::get('user.authUserLoginId') ?? 'null'  }},
                    "adminId": {{ Session::get('user.adminId') ?? 'null'  }},
                    "paymentTermsId": {{ Session::get('user.paymentTermsId') ?? 'null'  }},
                    "paymentTermsName": {{ Session::get('user.paymentTermsName') ?? 'null'  }},
                    "notes": {{ Session::get('user.notes') ?? 'null'  }},
                    "notes2": {{ Session::get('user.notes2') ?? 'null'  }},
                    "storeCredit": {{ Session::get('user.storeCredit') ?? 'null'  }},
                    "loyaltyPoints": {{ Session::get('user.loyaltyPoints') ?? 'null'  }},
                    "dueAmount": {{ Session::get('user.dueAmount') ?? 'null'  }},
                    "dueAmountStr": {{ Session::get('user.dueAmountStr') ?? 'null'  }},
                    "excessAmount": {{ Session::get('user.excessAmount') ?? 'null'  }},
                    "viewSpecificCategory": {{ Session::get('user.viewSpecificCategory') ?? 'null'  }},
                    "viewSpecificProduct": {{ Session::get('user.viewSpecificProduct') ?? 'null'  }},
                    "websiteReference": {{ Session::get('user.websiteReference') ?? 'null'  }},
                    "primaryBusiness": {{ Session::get('user.primaryBusiness') ?? 'null'  }},
                    "websiteUrl": {{ Session::get('user.websiteUrl') ?? 'null'  }},
                    "facebookLink": {{ Session::get('user.facebookLink')  ?? 'null' }},
                    "instagramLink": {{ Session::get('user.instagramLink')  ?? 'null' }},
                    "referBySalesRep": {{ Session::get('user.referBySalesRep') ?? 'null'  }},
                    "referBySalesRepName": {{ Session::get('user.referBySalesRepName')  ?? 'null' }},
                    "primarySalesRepresentativeId": {{ Session::get('user.primarySalesRepresentativeId') ?? 'null'  }},
                    "secondarySalesRepresentativeId": {{ Session::get('user.secondarySalesRepresentativeId') ?? 'null'  }},
                    "salesRepresentativeName": {{ Session::get('user.salesRepresentativeName') ?? 'null'  }},
                    "salesRepresentativePhone": {{ Session::get('user.salesRepresentativePhone') ?? 'null'  }},
                    "salesRepresentativeEmail": {{ Session::get('user.salesRepresentativeEmail') ?? 'null'  }},
                    "tobaccoId": {{ Session::get('user.tobaccoId') ?? 'null'  }},
                    "taxable": "{{ Session::get('user.taxable') ?? 'null'  }}",
                    "feinNumber": {{ Session::get('user.feinNumber') ?? 'null'  }},
                    "tobaccoLicenseExpirationDate": {{ Session::get('user.tobaccoLicenseExpirationDate')  ?? 'null' }},
                    "tobaccoLicenseExpirationDateString": {{ Session::get('user.tobaccoLicenseExpirationDateString')  ?? 'null' }},
                    "vaporTaxId": {{ Session::get('user.vaporTaxId')  ?? 'null' }},
                    "vaporTaxExpirationDate": {{ Session::get('user.vaporTaxExpirationDate') ?? 'null'  }},
                    "referByCustomerId": {{ Session::get('user.referByCustomerId')  ?? 'null' }},
                    "communicateViaPhone": "{{ Session::get('user.communicateViaPhone') ?? 'null'  }}",
                    "communicateViaText": "{{ Session::get('user.communicateViaText') ?? 'null'  }}",
                    "username": {{ Session::get('user.username') ?? 'null'  }},
                    "paymentMethodNonce": {{ Session::get('user.paymentMethodNonce') ?? 'null'  }},
                    "billingAddress": {{ Session::get('user.billingAddress') ?? 'null'  }},
                    "shippingAddress": {{ Session::get('user.shippingAddress')  ?? 'null' }},
                    "quickbooksCustomerId": {{ Session::get('user.quickbooksCustomerId') ?? 'null'  }},
                    "customerGroupId": {{ Session::get('user.customerGroupId')  ?? 'null' }},
                    "customerGroupName": {{ Session::get('user.customerGroupName')  ?? 'null' }},
                    "dbaName": {{ Session::get('user.dbaName')  ?? 'null' }},
                    "voidCheckNumber": {{ Session::get('user.voidCheckNumber')  ?? 'null' }},
                    "drivingLicenseNumber": {{ Session::get('user.drivingLicenseNumber')  ?? 'null' }},
                    "customerTypeId": {{ Session::get('user.customerTypeId') ?? 'null'  }},
                    "customerTypeName": {{ Session::get('user.customerTypeName')  ?? 'null' }},
                    "preferredLanguage": {{ Session::get('user.preferredLanguage') ?? 'null'  }},
                    "achVerified": {{ Session::get('user.achVerified')  ?? 'null' }},
                    "parentCustomerFirstName": {{ Session::get('user.parentCustomerFirstName') ?? 'null'  }},
                    "parentCustomerLastName": {{ Session::get('user.parentCustomerLastName') ?? 'null'  }},
                    "parentCustomerCompany": {{ Session::get('user.parentCustomerCompany')  ?? 'null' }},
                    "address1": {{ Session::get('user.address1') ?? 'null'  }},
                    "address2": {{ Session::get('user.address2') ?? 'null'  }},
                    "city": {{ Session::get('user.city') ?? 'null'  }},
                    "county": {{ Session::get('user.county')  ?? 'null' }},
                    "stateId": {{ Session::get('user.stateId')  ?? 'null' }},
                    "state": {{ Session::get('user.state')  ?? 'null' }},
                    "zip": {{ Session::get('user.zip') ?? 'null'  }},
                    "billingAddress1": {{ Session::get('user.billingAddress1')  ?? 'null' }},
                    "billingAddress2": {{ Session::get('user.billingAddress2') ?? 'null'  }},
                    "billingCity": {{ Session::get('user.billingCity') ?? 'null'  }},
                    "billingCounty": {{ Session::get('user.billingCounty')  ?? 'null' }},
                    "billingStateId": {{ Session::get('user.billingStateId') ?? 'null'  }},
                    "billingState": {{ Session::get('user.billingState') ?? 'null'  }},
                    "billingZip": {{ Session::get('user.billingZip') ?? 'null'  }},
                    "primaryBusinessName": {{ Session::get('user.primaryBusinessName') ?? 'null'  }},
                    "creditLimit": {{ Session::get('user.creditLimit') ?? 'null'  }},
                    "signUpStoreId": {{ Session::get('user.signUpStoreId')  ?? 'null' }},
                    "sendDuePaymentReminder": "{{ Session::get('user.sendDuePaymentReminder')  ?? 'null' }}",
                    "customerDocumentList": {{ Session::get('user.customerDocumentList') ?? 'null'  }},
                    "customerPaymentModePreferenceDtoList": {{ Session::get('user.customerPaymentModePreferenceDtoList') ?? 'null'  }}
                }
            };

            updateCustomer(data)
            .then(data => {
                // console.log('Updated customer data:', data);
                Toast.fire({
                        icon: `success`,
                        title: `Account update Successfully!`
                    });

                updateSessionInfo();
            })
            .catch(error => {
                alert('Error updating - customer:', error);
            });

        });

        });

        function updateSessionInfo() {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '/updateUserSession',
                data: {
                   firstname : $('#update-firstname').val(),
                   lastname : $('#update-lastname').val(),
                   companyName : $('#update-companyName').val(),
                   email : $('#update-email').val(),
                   phone : $('#update-phone').val(),
                   taxIx : $('#update-taxIx').val()
                },
                success: function (response) {

                },
                error: function (xhr, status, error) {


                }

            });
        }
</script>
@endsection
