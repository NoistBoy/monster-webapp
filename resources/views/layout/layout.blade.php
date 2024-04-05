@include('layout.header')
<!-- custom navbar start -->
@include('layout.navbar')
<!-- custom navbar End -->

<!-- responsive main layout  -->

<!-- Categories Sidebar  -->
@include('layout.sidebar')
<!-- Categories Sidebar  -->

<div class="content">
    @yield('content')

    <!-- footer -->
    @include('layout.footer')
</div>
<!-- responsive main layout END -->
@include('layout.scripts')

@yield('custom-scripts')
