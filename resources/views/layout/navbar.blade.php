<div class="nav text-light py-3 px-5 d-flex justify-content-between align-items-center" style="background: #000;">
    <span>#1 Distributor For Vape &amp; Smoke</span>
    <span class=" d-flex justify-content-between align-items-center" >Have Questions?&nbsp;&nbsp;&nbsp;<i class="lni lni-phone fs-6 text-primary"></i>&nbsp;&nbsp;(+1) 469-405-4000.</span>
</div>
<nav class="custom-navbar shadow">
    <div class="custom-navbar-container custom-container">
        <input type="checkbox" name="" id="">
        <div class="hamburger-lines">
            <span class="line line1"></span>
            <span class="line line2"></span>
            <span class="line line3"></span>
        </div>
        <div class="toggle-categories" onclick="toggleSidebar();">
            <span><i class="fa-solid fa-shop"></i></span>
            <!-- <span><b>Categories</b></span> -->
        </div>
        <a class="logo" href="{{ url('/') }}" style="width: 22% !important;" >
            <img src="{{ asset('asset/img/logo-monster.png') }}" class="img-fluid" alt="logo" srcset="" style="width: 100% !important;" style=" object-fit:contain;">
        </a>

        <div class="menu-items">
            <ul class="nav-item-custom d-flex justify-content-center align-items-center mb-0 menu">
                {{-- <li><a href="#" class="d-flex justify-content-center align-items-center" style="font-size: large;">
                    What's&nbsp;New&nbsp;<i class="lni lni-chevron-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="#" style="font-size: large;" >Submenu Item 1</a></li>
                        <li><a href="#" style="font-size: large;" >Submenu Item 2</a></li>
                        <li><a href="#" style="font-size: large;" >Submenu Item 3</a></li>
                    </ul>
                </li>
                <li><a href="#" class="d-flex justify-content-center align-items-center"  style="font-size: large;" >
                    Limited&nbsp;Offers&nbsp;<i class="lni lni-chevron-down"></i> </a>
                    <ul class="dropdown">
                        <li><a href="#" style="font-size: large;" >Submenu Item 1</a></li>
                        <li><a href="#" style="font-size: large;" >Submenu Item 2</a></li>
                        <li><a href="#" style="font-size: large;" >Submenu Item 3</a></li>
                    </ul>
                </li> --}}
                <li><a href="#" style="font-size: large;" class=" d-flex justify-content-center align-items-center" ><i class="lni lni-phone"></i>&nbsp;(+1) 469-405-4000</a></li>
            </ul>

            {{-- <form class="d-flex mb-0" role="search">
                <div class="container-input">
                    <input type="search" class="nav-search-input " placeholder="Search Products, Category, brand"
                        name="text">
                    <span>
                        <i class="fa-solid fa-magnifying-glass fs-5"></i>
                    </span>
                </div>
            </form> --}}
            <div class="search" style="position: relative;">
                <div class="search-box">
                  <div class="search-field">
                    <input placeholder="Search..." class="input" type="search" id="search-product-input"  >
                    <div class="search-box-icon">
                      <button class="btn-icon-content">
                        <i class="search-icon">
                          <svg xmlns="://www.w3.org/2000/svg" version="1.1" viewBox="0 0 512 512">
                            <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" fill="#000"></path></svg>
                        </i>
                      </button>
                    </div>
                  </div>
                </div>

                <div id="search-result" class="shadow w-100  pt-4 mt-2" style="position: absolute;    overflow: hidden;  z-index:-1; top: 25px; border-radius:10px; background: #FFFFFF; display:none;">

                </div>
              </div>
            <ul class=" d-flex justify-content-center align-items-center mb-2 mb-lg-0 fs-4 fw-bold margin-top-sm nav-sochial-icons menu" >
                {{-- <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#"><i class="lni lni-phone"></i></a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="{{ url('/add-to-cart') }}"><i class="lni lni-cart" style="position: relative; position: relative;
                        padding: 10px;
                        background: #3c3b6e;
                        border-radius: 10pc;
                        color: #FFFFFF;
                        font-weight: bold;
                        font-size: 38px;" >
                        <span class="cart-count" >0</span></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#"><i class="lni lni-user"></i>&nbsp;
                        @if (Session::has('user.accessToken'))
                            {{ Session::get('user.firstName') }}
                        @else
                            &nbsp;SignIn&nbsp;/&nbsp;SignUp&nbsp;
                        @endif
                    </a>
                    @if (Session::has('user.accessToken'))
                        <ul class="dropdown" style="text-align: left;">
                            <li><a href="{{ Url('/user-dashboard') }}" class="d-flex justify-content-center align-items-center" >Dashboard
                                {{-- &nbsp;&nbsp;<i class="lni lni-exit"></i> --}}
                            </a></li>
                            <li><a href="{{ Url('/log-out') }}" class="d-flex justify-content-center align-items-center" >Log Out
                                 {{-- &nbsp;&nbsp;<i class="lni lni-exit"></i> --}}
                                </a></li>
                        </ul>
                    @else
                        <ul class="dropdown" >
                            <li><a href="{{ Url('/sign-in') }}" class="d-flex justify-content-center align-items-center" >Sign In</a></li>
                            <li><a href="{{ Url('/sign-up') }}" class="d-flex justify-content-center align-items-center" >Create an Account</a></li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
