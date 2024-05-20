@extends('layout-parshal.layout-parshal')



@section('custom-style')
    @include('dashboardStyle')
    <style>

      .date-filter {
          display: flex;
          justify-content: end;
          align-items: center;
          gap: 10px;
          margin-bottom: 20px;
      }

      .date-filter input {
          padding: 10px;
          font-size: 16px;
          border: 1px solid #ddd;
          border-radius: 5px;
      }

      .date-filter button {
          padding: 10px 15px !important;
          background-color: #4CAF50;
          color: white;
          border: none;
          cursor: pointer;
          font-size: 16px;
          border-radius: 5px;
          transition: background-color 0.3s ease;
      }

      .date-filter button:hover {
          background-color: #45a049;
      }

      .table-container {
          /* max-height: 360px; */
          overflow-y: auto;
          border: 1px solid #ddd;
          border-radius: 10px;
      }

      .table {
          width: 100%;
          border-collapse: collapse;
      }

      .table th,
      .table td {
          padding: 15px;
          text-align: left;
          border-bottom: 1px solid #ddd;
      }

      /* .table th {
          position: sticky;
          top: 0;
          background-color: #f2f2f2;
          color: #333;
      } */
      .table th {
        position: sticky;
        top: 0;
        background-color: #3c3b6e;
        color: #fff;
      }

      .table tr:nth-child(even) {
          background-color: #f9f9f9;
      }

      .table tr:hover {
          background-color: #f1f1f1;
      }

      .action-btn {
          background-color: transparent;
          border: none;
          cursor: pointer;
          font-size: 18px;
          margin: 0 5px;
      }

      @media screen and (max-width: 768px) {
          .table th, .table td {
              padding: 10px;
              font-size: 14px;
          }

          .date-filter {
              flex-direction: column;
              align-items: center;
          }

          .date-filter input,
          .date-filter button {
              width: 100%;
              margin: 5px 0;
          }
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
                                <span  style="font-size: 35px;" >Dashboard</span>
                                <p id="user-time-message" ></p>
                            </div>
                        </div>
                    </div>
                    {{--  --}}
                    @include('dashboard-off-canvas')
                    {{--  --}}
                    <div class="container-fluid dashboard-details-section"
                        style="  display: grid;  grid-template-columns: repeat(auto-fit, minmax(414px, 1fr)); gap: 20px;">
                        <!-- Single Info Card -->
                        <div class="info-card me-auto  col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; background:#FFFFFF; ">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-box fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Total&nbsp;Number Of Orders</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="totalNumberOfOrders"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto  col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; background:#FFFFFF; ">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-file-invoice fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Total&nbsp;Amount Spend</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="totalAmountSpend"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto  col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; background:#FFFFFF; ">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Due&nbsp;Amount</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="dueAmount"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto  col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; background:#FFFFFF; ">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-store fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Store&nbsp;Credit</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="storeCredit"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto  col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; background:#FFFFFF; ">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Rma&nbsp;Credit</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="rmaCredit"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->
                        <!-- Single Info Card -->
                        <div class="info-card me-auto  col-sm-12 mb-3 px-5 py-4 shadow d-flex  align-items-center f-dir-sm-column"
                            style=" gap: 20px;  border-radius: 20px; margin-right:20px !important; background:#FFFFFF; ">
                            <div class="bg-primary-blue-light color-primary-blue"
                                style="padding: 7px 7px; border-radius: 50px; width: 60px; height: 60px; display: flex; justify-content: center; align-items: center; ">
                                <span>
                                    <i class="fa-solid fa-dollar-sign fs-1 fw-bold"></i>
                                </span>
                            </div>
                            <div class=" d-flex flex-column">
                                <span style="font-weight: 600;">Buy&nbsp;Back Credit</span>
                                <span class="fw-bold " style="font-size: 1.7rem;" id="buyBackCredit"><i
                                        class="fa-solid fa-arrows-rotate"></i></span>
                            </div>
                        </div>
                        <!-- Single Info Card End-->

                    </div>
                </div>
                {{-- Resend Orders Old --}}
                {{-- <div class="row  margin-left-small-view mt-5">
                        <div class="col-12">

                            <div class="" style="border-radius:20px;">
                                <div class="row">
                                    <div class="col-md-4 col-sm-12">
                                        <h2 class="mb-5 fw-bold">Recent&nbsp;Orders</h2>
                                    </div>
                                    <div class="col-md-8 col-sm-12 d-flex justify-content-end">

                                        <div class="row mb-3">
                                            <label for="frm-date" class="col-sm-2 col-form-label">From&nbsp;date&nbsp;</label>
                                            <div class="col-sm-3">
                                                <input type="date" name="frm-date" class="form-control" id="frm-date">
                                            </div>

                                            <label for="to-date" class="col-sm-2 col-form-label">To&nbsp;date&nbsp;</label>
                                            <div class="col-sm-3 mb-3">
                                                <input type="date" name="to-date" class="form-control" id="to-date">
                                            </div>

                                            <div class="col-2 mb-3">
                                                <button class="btn btn-monster" id="apply-date-filter" onclick="customerResendOrders(0, $('#frm-date').val(), $('#to-date').val())" >Apply</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">

                                            <div class="col-12" style="overflow-x: auto;">

                                                <table class="table table-bordered table-striped table-hover table-responsive">
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

                                                <div class="row">
                                                    <div class="col-12 py-3 px-3">
                                                        <div class="pagination-cover">
                                                            <nav aria-label="..." class="product-pagination">

                                                            </nav>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                            </div>
                    </div> --}}
                    {{-- Resend Orders End --}}

                <!-- The new table added -->

                <div class="container shadow">
                    <h2>Recent Orders</h2>
                    <div class="date-filter">
                        <label for="">From</label>
                        <input type="date" id="frm-date" placeholder="Start Date">
                        <label for="">To</label>
                        <input type="date" id="to-date" placeholder="End Date">
                        <button class="btn btn-monster" id="apply-date-filter" onclick="customerResendOrders(0, $('#frm-date').val(), $('#to-date').val())" >APPLY</button>
                    </div>
                    <div class="table-container">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Ship To</th>
                                    <th>Total Amount</th>
                                    <th>Total Due</th>
                                    <th>Status</th>
                                    <th>Tracking Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="resend-sell-orders">

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-12 py-3 px-3">
                            <div class="pagination-cover">
                                <nav aria-label="..." class="product-pagination">

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- The new table added -->

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
            getGreetingMessage();
            userDashBoardDetails().then(data => {
                if (!data.hasError) {
                        $('#totalNumberOfOrders').html(data.result.totalNumberOfOrders);
                        $('#totalAmountSpend').html("$" + parseFloat(data.result.totalAmountSpend)
                            .toFixed(2));
                        $('#dueAmount').html("$" + parseFloat(data.result.dueAmount).toFixed(2));
                        $('#storeCredit').html("$" + parseFloat(data.result.storeCredit).toFixed(
                        2));
                        $('#rmaCredit').html("$" + parseFloat(data.result.rmaCredit).toFixed(2));
                        $('#buyBackCredit').html("$" + parseFloat(data.result.buyBackCredit)
                            .toFixed(2));
                    }

            }).catch(error => {
                alert(error);
            });

            customerResendOrders();

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

            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     type: 'GET',
            //     url: '/user-dashboard-details',
            //     success: function(response) {

            //         if (!response.hasError) {
            //             $('#totalNumberOfOrders').html(response.result.totalNumberOfOrders);
            //             $('#totalAmountSpend').html("$" + parseFloat(response.result.totalAmountSpend)
            //                 .toFixed(2));
            //             $('#dueAmount').html("$" + parseFloat(response.result.dueAmount).toFixed(2));
            //             $('#storeCredit').html("$" + parseFloat(response.result.storeCredit).toFixed(
            //             2));
            //             $('#rmaCredit').html("$" + parseFloat(response.result.rmaCredit).toFixed(2));
            //             $('#buyBackCredit').html("$" + parseFloat(response.result.buyBackCredit)
            //                 .toFixed(2));
            //         }
            //     },
            //     error: function(xhr, status, error) {
            //         console.log("Some thing went wrong");
            //     }
            // });

            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     type: 'GET',
            //     url: '/get-orders',
            //     success: function(response) {
            //         tr = "";
            //         if (!response.hasError) {
            //             response.result.content.forEach(element => {
            //                 tr += `<tr>
            //                     <td>${element.orderId}</td>
            //                     <td>${element.insertedTimestamp}</td>
            //                     <td>${element.trackingNumber ?? ""}</td>
            //                     <td>${element.totalAmount}</td>
            //                     <td>${element.dueBalance}</td>
            //                     <td><span class="alert alert-danger p-1" >${element.status}</span></td>
            //                     <td>${element.trackingNumber ?? ""}</td>
            //                     <td style="cursor:pointer;" >
            //                         <i class="fa-solid fa-eye" onClick="seeInvDetails(${element.orderId})"></i>
            //                     </td>
            //                   </tr>`;
            //             });
            //         }
            //         $('#resend-sell-orders').html(tr);
            //     },
            //     error: function(xhr, status, error) {
            //         console.log("Some thing went wrong");
            //     }
            // });
        });

        function seeInvDetails(InvID) {
            var url = "https://erp.monstersmokewholesale.com/services/pdf/sales-order/invoice/" + InvID + "?token=" +
                token + "&defaultStoreId=2&storeIdList=1,2&isEcommerce=true";
            var iframe = `<iframe src="${url}" width="100%" height="100%" title="Order Details"></iframe>`;
            $('#details-views').html(iframe);
            modal.style.display = "block";

        }

        function customerResendOrders(page = 0 ,frmDate = '', toDate = '') {


            var url = 'https://erp.monstersmokewholesale.com/api/ecommerce/dashboard/orderTable?page='+page+'&size=5';
            if (frmDate !== '') {
                url += `&startDate=${frmDate}`;
            }
            if (toDate !== '') {
                url += `&endDate=${toDate}`;
            }

            getOrders(url).then(data => {
                // console.log("The User Detail " + data);
                tr = "";
                    if (!data.hasError) {

                        data.result.content.forEach(element => {
                            tr += `<tr>
                                <td>${element.orderId}</td>
                                <td>${element.insertedTimestamp}</td>
                                <td>${element.trackingNumber ?? ""}</td>
                                <td>${element.totalAmount}</td>
                                <td>${element.dueBalance}</td>
                                <td><span class="fw-bold" >${element.status}</span></td>
                                <td>${element.trackingNumber ?? ""}</td>
                                <td style="cursor:pointer;" >
                                    <i class="fa-solid fa-eye" onClick="seeInvDetails(${element.orderId})"></i>
                                    &nbsp;&nbsp;
                                    <a href="https://erp.monstersmokewholesale.com/api/ecommerce/order/${element.orderId}/export/csv?storeIds=1,2" >
                                        <i class="fa-solid fa-download" ></i>
                                    </a>
                                </td>
                              </tr>`;
                        });

                        // pagination
                        const totalPages = data.result.totalPages;
                        const currentPage = parseInt(data.result.number) + 1;

                        // Calculate the range of pages to display
                        let startPage = Math.max(1, currentPage - 4); // Show 4 pages before the current page
                        let endPage = Math.min(startPage + 9, totalPages); // Show up to 10 pages, or less if close to the end

                        let Pagination = `<ul class="pagination">`;

                        // Previous page link
                        Pagination += `<li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                                            <a class="page-link" href="javascript:customerResendOrders(${currentPage === 1 ? 0 : currentPage - 2})">Previous</a>
                                        </li>`;

                        // Generate page links within the range
                        for (let i = startPage; i <= endPage; i++) {
                            const active = currentPage === i ? 'active' : '';
                            Pagination += `<li class="page-item ${active}">
                                                <a class="page-link" href="javascript:customerResendOrders(${i - 1})">${i}</a>
                                            </li>`;
                        }

                        // Next page link
                        Pagination += `<li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                                            <a class="page-link" href="javascript:customerResendOrders(${currentPage === totalPages ? totalPages - 1 : currentPage})">Next</a>
                                        </li>
                                    </ul>`;

                        // pagination end

                        $('.product-pagination').html(Pagination);

                    }
                    $('#resend-sell-orders').html(tr);

            }).catch(error => {
                alert(error);
            });

        }

        async function getOrders(url) {
            const token = 'Bearer {{Session::get('user.accessToken')}}';

            const headers = {
                'Content-Type': 'application/json',
                'Accept': 'application/json, text/plain, */*',
                'Authorization': token,
                'Connection': 'keep-alive',
                'Origin': 'https://www.monstersmokewholesale.com',
                'Referer': 'https://www.monstersmokewholesale.com/',
                'Sec-Fetch-Dest': 'empty',
                'Sec-Fetch-Mode': 'cors',
                'Sec-Fetch-Site': 'same-site',
                'Sec-GPC': '1',
                'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/122.0.0.0 Safari/537.36',
                'sec-ch-ua': '"Chromium";v="122", "Not(A:Brand";v="24", "Brave";v="122"',
                'sec-ch-ua-mobile': '?0',
                'sec-ch-ua-platform': '"macOS"'
            };
            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: headers
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Error fetching orders:', error);
                throw error;
            }
        }

        async function userDashBoardDetails() {
            const accessToken = "{{ Session::get('user.accessToken') }}";
            const url = 'https://erp.monstersmokewholesale.com/api/ecommerce/dashboard';

            try {
                const response = await fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + accessToken,
                    }
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok' + response.statusText);
                }

                const data = await response.json();
                return data;
            } catch (error) {
                alert('There has been a problem with your fetch operation:', error);
            }
        }

    </script>
    <script>
        function getGreetingMessage() {
            const currentTime = new Date();
            const currentHour = currentTime.getHours();

            let greeting;

            let emoji;

            if (currentHour < 12) {
                greeting = 'Good Morning';
                emoji = '🌅';
            } else if (currentHour < 18) {
                greeting = 'Good Afternoon';
                emoji = '☀️';
            } else if (currentHour < 22) {
                greeting = 'Good Evening';
                emoji = '🌇';
            } else {
                greeting = 'Good Night';
                emoji = '🌙';
            }


             greeting = `${emoji} ${greeting} <span class='text-success' >{{ Session::get('user.firstName') }}</span>`;

             $('#user-time-message').html(greeting + '!') ;
            }

    </script>
@endsection
