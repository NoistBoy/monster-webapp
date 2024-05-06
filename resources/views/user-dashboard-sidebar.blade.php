<div class="col-md-2 col-12 sideBar-wrapper sidebar-open">
    <div class="row bg-primary-red-light" style="border-radius: 20px;">
        <div class="col-12 px-4 py-5">
            <ul style=" padding-left:0; cursor:pointer; " class="color-primary-blue">
                <li class="{{ Request::is('user-dashboard') ? 'active-dashboard-item' : '' }}  mb-2 label  fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
                   <a href="{{ url('/user-dashboard') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-dashboard') ? '' : 'color-primary-blue' }} "><span class="">Dashboard</span><i class="lni lni-chevron-right"></i></a>
                </li>
                <li class="{{ Request::is('user-profile') ? 'active-dashboard-item' : '' }} mb-2 label fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
                    <a href="{{ url('/user-profile') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-profile') ? '' : 'color-primary-blue' }} "><span class="">My Profile</span><i class="lni lni-chevron-right"></i></a>
                </li>
                <li class="{{ Request::is('user-addressList') ? 'active-dashboard-item' : '' }} mb-2 label fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
                    <a href="{{ url('/user-addressList') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-addressList') ? '' : 'color-primary-blue' }} "><span class="">Address List</span><i class="lni lni-chevron-right"></i></a>
                </li>
                <li class="{{ Request::is('user-forgotPassword') ? 'active-dashboard-item' : '' }} mb-2 label  fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
                    <a href="{{ url('/user-forgotPassword') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-forgotPassword') ? '' : 'color-primary-blue' }}  "><span class="">Forgot Password</span><i class="lni lni-chevron-right"></i></a>
                </li>
            </ul>
        </div>
    </div>
</div>
