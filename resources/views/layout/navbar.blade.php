<nav class="custom-navbar sticky-top">
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
        <a class="logo" href="{{ url('/') }}">
            <img src="{{ asset('asset/img/logo-monster.jpg') }}" alt="logo" srcset="">
        </a>

        <div class="menu-items">
            <ul class="nav-item-custom d-flex justify-content-center align-items-center mb-0 menu">
                <li><a href="#" class="d-flex justify-content-center align-items-center">What's New&nbsp;&nbsp;<i
                            class="lni lni-chevron-down"></i></a>
                    <ul class="dropdown">
                        <li><a href="#">Submenu Item 1</a></li>
                        <li><a href="#">Submenu Item 2</a></li>
                        <li><a href="#">Submenu Item 3</a></li>
                    </ul>
                </li>
                <li><a href="#" class="d-flex justify-content-center align-items-center" >Limited Offers &nbsp;&nbsp;<i
                    class="lni lni-chevron-down"></i> </a>
                    <ul class="dropdown">
                        <li><a href="#">Submenu Item 1</a></li>
                        <li><a href="#">Submenu Item 2</a></li>
                        <li><a href="#">Submenu Item 3</a></li>
                    </ul>
                </li>
                <li><a href="#">Discounted Products</a></li>
            </ul>

            <form class="d-flex" role="search">
                <div class="container-input">
                    <input type="search" class="nav-search-input " placeholder="Search Products, Category, brand"
                        name="text">
                    <span>
                        <i class="fa-solid fa-magnifying-glass fs-5"></i>
                    </span>
                </div>
            </form>
            <ul class="  mb-2 mb-lg-0 fs-4 fw-bold margin-top-sm nav-sochial-icons menu" style="display: flex;">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#"><i class="lni lni-phone"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#"><i class="lni lni-cart"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#"><i class="lni lni-user"></i></a>
                    @if (Session::has('user.accessToken'))
                        <ul class="dropdown" style="right: 20px;">
                            <li><a href="{{ Url('/log-out') }}" class="d-flex justify-content-center align-items-center" >Log Out &nbsp;&nbsp;<i class="lni lni-exit"></i></a></li>
                        </ul>
                    @else
                        <ul class="dropdown" style="right: 20px;">
                            <li><a href="{{ Url('/sign-in') }}" class="d-flex justify-content-center align-items-center" >Sign In</a></li>
                            <li><a href="{{ Url('/sign-up') }}" class="d-flex justify-content-center align-items-center" >Create an Account</a></li>
                        </ul>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
