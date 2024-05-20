<ul style=" padding-left:0; cursor:pointer; " class="color-primary-blue">
    <li class="{{ Request::is('user-dashboard') ? 'active-dashboard-item' : '' }}  mb-2 label  fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
       <a href="{{ url('/user-dashboard') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-dashboard') ? '' : 'color-primary-blue' }} "><span class=""><i class="fa-solid fa-gauge"></i>&nbsp;&nbsp;Dashboard</span><i class="lni lni-chevron-right"></i></a>
    </li>
    <li class="{{ Request::is('user-profile') ? 'active-dashboard-item' : '' }} mb-2 label fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
        <a href="{{ url('/user-profile') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-profile') ? '' : 'color-primary-blue' }} "><span class=""><i class="fa-solid fa-user"></i>&nbsp;&nbsp;My Profile</span><i class="lni lni-chevron-right"></i></a>
    </li>
    <li class="{{ Request::is('user-addressList') ? 'active-dashboard-item' : '' }} mb-2 label fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
        <a href="{{ url('/user-addressList') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-addressList') ? '' : 'color-primary-blue' }} "><span class=""><i class="fa-solid fa-house"></i>&nbsp;&nbsp;Address List</span><i class="lni lni-chevron-right"></i></a>
    </li>
    <li class="{{ Request::is('user-changePassword') ? 'active-dashboard-item' : '' }} mb-2 label  fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
        <a href="{{ url('/user-changePassword') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-changePassword') ? '' : 'color-primary-blue' }}  "><span class=""><i class="fa-solid fa-lock"></i>&nbsp;&nbsp;Change Password</span><i class="lni lni-chevron-right"></i></a>
    </li>
    <li class="{{ Request::is('user-statement') ? 'active-dashboard-item' : '' }} mb-2 label  fw-bold" style="border: 1px solid #f8f9fa; padding: 10px; border-radius: 10px; background:#FFFFFF;" >
        <a href="{{ url('/user-statement') }}" class=" nav-link d-flex justify-content-between align-items-center text-decoration-none {{ Request::is('user-statement') ? '' : 'color-primary-blue' }}  "><span class=""><i class="fa-solid fa-file-lines"></i>&nbsp;&nbsp;Statement</span><i class="lni lni-chevron-right"></i></a>
    </li>
</ul>
