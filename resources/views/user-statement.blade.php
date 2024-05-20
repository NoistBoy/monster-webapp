@extends('layout-parshal.layout-parshal')



@section('custom-style')
    @include('dashboardStyle')

    <style>
        .page-link{
            color: #3c3b6e !important;
        }

        .active>.page-link, .page-link.active {
            background-color: #b22234 !important;
            border-color: #3c3b6e !important;
            color: #FFFFFF !important;
            z-index: 0;
        }
        #user-time-message{
            width: 100%;
            text-align: right;
            font-size: 35px;
        }

    </style>
@endsection

@section('content')
<div class="container-fluid p-dynamic " style="overflow: hidden;">
    <div class="row py-5 px-3  section-wrapper-dashboard" style="border-radius: 20px;">
            @include('user-dashboard-sidebar')
            <div class="col-md-10 col-12 mainContent-wrapper">

            <div class="container shadow mb-4">

                <div class="row margin-left-small-view mb-4 mt-4">
                    <div class="col-12">
                        <div class="d-flex justify-content-center align-items-center gap-3 fs-4 fw-bold">
                            <span style="cursor: pointer;" class="d-none-sm" id="ToggleSideBar"><i
                                    class="fa-solid fa-angles-left" id="dashboard-icon"  style="font-size: 34px;" ></i></span>
                            <span  style="font-size: 35px;" >Statement</span>
                            <p id="user-time-message" ></p>
                        </div>
                    </div>
                </div>
                {{--  --}}
                @include('dashboard-off-canvas')
                {{--  --}}

                <div class="row ">
                    <div class="container-fluid dashboard-details-section"
                        style="  display: grid;  grid-template-columns: repeat(auto-fit, minmax(414px, 1fr)); gap: 20px;">
                        <!-- Single Info Card -->
                        <div class="info-card me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="a-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Opening&nbsp;Balance</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="openingBalance"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="a-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Invoiced&nbsp;Amount</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="invoicedAmount"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="a-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Amount&nbsp;Received</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="amountReceived"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important;">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="a-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Total&nbsp;DueBalance</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="totalDueBalance"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                    </div>
                </div>

            </div>

                {{-- <div class="row  mt-5">
                    <div class="col-12"> --}}

                        <div class="container shadow">
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                </div>
                                <div class="col-md-4 col-sm-12 mb-2 mb-4 d-flex justify-content-end">
                                    <button class="btn btn-monster" id="print-statement" onclick="" style="height: 50px;" >Print Statement</button>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <h2 class="mb-5 fw-bold">Statements</h2>
                                </div>

                                <div class="col-md-6 col-sm-12 d-flex justify-content-end">
                                    <div class="row mb-3">
                                        <label for="frm-date" class="col-sm-2 col-form-label">From&nbsp;date&nbsp;</label>
                                        <div class="col-sm-3">
                                            <input type="date" name="frm-date" class="form-control"  id="frm-date">
                                        </div>

                                        <label for="to-date" class="col-sm-2 col-form-label">To&nbsp;date&nbsp;</label>
                                        <div class="col-sm-3 mb-3">
                                            <input type="date" name="to-date" class="form-control" id="to-date">
                                        </div>

                                        <div class="col-2 mb-3">
                                            <button class="btn btn-monster" id="apply-date-filter" onclick="fetchCustomerReportStatement($('#frm-date').val(), $('#to-date').val())" >Apply</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                                <div class="row">

                                        <div class="col-12" style="overflow-x: auto;">

                                                    <table id="statement-table" class="table table-striped" style="width:100%" >
                                                        <thead>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Type</th>
                                                                <th>Excess Amt</th>
                                                                <th>Credit</th>
                                                                <th>Debit</th>
                                                                <th>Balance</th>
                                                                <th>Order Id</th>
                                                                <th>Description</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="order-statements">

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>Date</th>
                                                                <th>Type</th>
                                                                <th>Excess Amt</th>
                                                                <th>Credit</th>
                                                                <th>Debit</th>
                                                                <th>Balance</th>
                                                                <th>Order Id</th>
                                                                <th>Description</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>


                                        </div>
                                    </div>
                            </div>

                    {{-- </div>
                    </div> --}}




            </div>
        </div>
    </div>

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
            const dateRange = getFormattedDateRange();

            fetchCustomerReportStatement(dateRange.startDate, dateRange.endDate);

            $('#print-statement').click(function (e) {
                e.preventDefault();

                var frmDate = dateRange.startDate;
                var toDate = dateRange.endDate;

                if($('#frm-date').val() != '' && $('#frm-date').val() != null ){
                    frmDate = $('#frm-date').val();
                }
                if($('#to-date').val() != '' && $('#to-date').val() != null ){
                    toDate = $('#to-date').val();
                }
                const url = `https://erp.monstersmokewholesale.com/services/pdf/cusomter/statement?token={{ Session::get('user.accessToken') }}&startDate=${frmDate}&endDate=${toDate}&customerIds=896&storeIdList=1,2&defaultStoreId=2`;
                window.open(url, '_blank');

            });

            $('#ToggleSideBar').click(function() {
                $('.sideBar-wrapper').toggleClass('sidebar-open');
                $('.mainContent-wrapper').toggleClass('col-md-12');
                if ($('#dashboard-icon').hasClass('fa-angles-left')) {
                    $('#dashboard-icon').removeClass('fa-angles-left');
                    $('#dashboard-icon').addClass('fa-angles-right');
                } else {
                    $('#dashboard-icon').removeClass('fa-angles-right');
                    $('#dashboard-icon').addClass('fa-angles-left');
                }

            });

        });

    </script>
    <script>
        function fetchCustomerReportStatement(frmDate, toDate) {
            // new DataTable('#statement-table', {
            //     destroy: true
            // });
            customerId = "{{ Session::get('user.user_id') }}";
            url = `https://erp.monstersmokewholesale.com/api/ecommerce/customer/report/statement?storeIds=1,2&page=0&size=20&startDate=${frmDate}&endDate=${toDate}&customerIds=${customerId}`;
            accessToken = "{{ Session::get('user.accessToken') }}";

            const requestOptions = {
                method: 'GET',
                headers: {
                'Authorization': `Bearer ${accessToken}`
                }
            };

            return fetch(url, requestOptions)
                .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok ' + response.statusText);
                }
                return response.json();
                })
                .then(data => {
                    tr = "";
                    if (!data.hasError) {


                        $('#openingBalance').html("$" + parseFloat(data.result.customerStatementSummaryDto.openingBalance).toFixed(2));
                        $('#invoicedAmount').html("$" + parseFloat(data.result.customerStatementSummaryDto.invoicedAmount).toFixed(2));
                        $('#amountReceived').html("$" + parseFloat(data.result.customerStatementSummaryDto.amountReceived).toFixed(2));
                        $('#totalDueBalance').html("$" + parseFloat(data.result.customerStatementSummaryDto.totalDueBalance).toFixed(2));

                        data.result.customerDetailedStatementReportDtoList.forEach(element => {
                            tr += `<tr>
                                    <td >${element.date}</td>
                                    <td >${element.type ?? ""}</td>
                                    <td >$${element.excessAmount.toFixed(2)}</td>
                                    <td >$${element.creditAmount.toFixed(2)}</td>
                                    <td >$${element.debitAmount.toFixed(2)}</td>
                                    <td >$${element.balance.toFixed(2)}</td>
                                    <td >${element.id}</td>
                                    <td>${element.description}</td>
                                </tr>`;
                        });

                    }
                    $('#order-statements').html(tr);
                    new DataTable('#statement-table');
                    // return data;

                })
                .catch(error => {
                    alert('Error:', error);
                    throw error;
                });
        }
    </script>

    <script>
        function getFormattedDateRange() {
            const now = new Date();

            // Get the first day of the current month
            const firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
            const firstDayFormatted = formatDate(firstDay);

            // Get the current date and time
            const currentDateFormatted = formatDate(now);

            return {
                startDate: firstDayFormatted,
                endDate: currentDateFormatted
            };
            }

            function formatDate(date) {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0'); // getMonth() is zero-based
            const day = String(date.getDate()).padStart(2, '0');
            const hours = String(date.getHours()).padStart(2, '0');
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');

            return `${year}-${month}-${day}+${hours}:${minutes}:${seconds}`;
            }


    </script>
@endsection
