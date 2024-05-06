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
                            <span>Dashboard</span>
                        </div>
                    </div>
                </div>
                <div class="row pt-5" style="margin-left: 2rem;">

                    <div class="container-fluid" style="  display: grid;  grid-template-columns: repeat(auto-fit, minmax(414px, 1fr)); gap: 20px;">
                        <!-- Single Info Card -->
                        <div class="me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-box fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Total Number Of Orders</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="totalNumberOfOrders" ><i class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-file-invoice fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;"  >Total Amount Spend</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="totalAmountSpend"><i class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Due Amount</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="dueAmount"><i class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-store fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Store Credit</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="storeCredit" ><i class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Rma Credit</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="rmaCredit"><i class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center flex-row" style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue" style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Buy Back Credit</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="buyBackCredit"><i class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->

                    </div>
                    {{-- Resend Orders --}}
                    <div class="container-fluid shadow" style="border-radius:20px;">
                        <div class="row">
                            <div class="col-12 p-5">
                                <h2 class="mb-5 fw-bold">Recent Orders</h2>
                                <table class="table table-striped table-hover table-responsive">
                                    <thead>
                                        <th>Order</th>
                                        <th>Date</th>
                                        <th>Ship To</th>
                                        <th>Total Amount </th>
                                        <th>Total Due</th>
                                        <th>Status</th>
                                        <th>Tracking Number</th>
                                        <th>Action</th>
                                    </thead>
                                    <tbody id="resend-sell-orders" >

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- Resend Orders End--}}

                        <!-- The Modal -->
                        <div id="myModal" class="modal">

                            <!-- Modal content -->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <span class="close" id="close-model">&times;</span>

                                </div>
                                <div class="modal-body" id="details-views" style="height: 40rem;">

                                </div>
                                {{-- <div class="modal-footer">
                                    <h3>Modal Footer</h3>
                                </div> --}}
                            </div>

                        </div>



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

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/user-dashboard-details',
            success: function (response) {

                if(!response.hasError){
                    $('#totalNumberOfOrders').html(response.result.totalNumberOfOrders);
                    $('#totalAmountSpend').html("$"+parseFloat(response.result.totalAmountSpend).toFixed(2));
                    $('#dueAmount').html("$"+parseFloat(response.result.dueAmount).toFixed(2));
                    $('#storeCredit').html("$"+parseFloat(response.result.storeCredit).toFixed(2));
                    $('#rmaCredit').html("$"+parseFloat(response.result.rmaCredit).toFixed(2));
                    $('#buyBackCredit').html("$"+parseFloat(response.result.buyBackCredit).toFixed(2));
                }
            },
            error: function (xhr, status, error) {
                console.log("Some thing went wrong");
            }
        });
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: 'GET',
            url: '/get-orders',
            success: function (response) {
                tr = "";
                if(!response.hasError){
                    response.result.content.forEach(element => {
                        tr += `<tr>
                                <td>${element.orderId}</td>
                                <td>${element.insertedTimestamp}</td>
                                <td>${element.trackingNumber ?? ""}</td>
                                <td>${element.totalAmount}</td>
                                <td>${element.dueBalance}</td>
                                <td><span class="alert alert-danger p-1" >${element.status}</span></td>
                                <td>${element.trackingNumber ?? ""}</td>
                                <td style="cursor:pointer;" >
                                    <i class="fa-solid fa-eye" onClick="seeInvDetails(${element.orderId})"></i>
                                </td>
                              </tr>`;
                    });
                }
                $('#resend-sell-orders').html(tr);
            },
            error: function (xhr, status, error) {
                console.log("Some thing went wrong");
            }
        });
    });

    function seeInvDetails(InvID) {
        var url = "https://erp.monstersmokewholesale.com/services/pdf/sales-order/invoice/"+InvID+"?token="+token+"&defaultStoreId=2&storeIdList=1,2&isEcommerce=true";
        var iframe = `<iframe src="${url}" width="100%" height="100%" title="Order Details"></iframe>`;
        $('#details-views').html(iframe);
        modal.style.display = "block";

    }
</script>
<script>

    //   function downloadPDF() {
    //     debugger;
    //     e.preventDefault();
    //     var pdfUrl = `https://erp.monstersmokewholesale.com/services/pdf/sales-order/invoice/17313?token=${token}&defaultStoreId=2&storeIdList=1,2&isEcommerce=true`;
    //     var fileName = "invoice.pdf";
    //     downloadPDF(pdfUrl, fileName);
    //   };


    // function downloadPDF(url, fileName) {
    //   var link = document.createElement('a');
    //   link.href = url;
    //   link.download = fileName;
    //   document.body.appendChild(link);
    //   link.click();
    //   document.body.removeChild(link);
    // }
    </script>
@endsection
