@include('layout.header')

    <!-- custom navbar start -->
    @include('layout.navbar')
    <!-- custom navbar End -->

    <!-- responsive main layout  -->

    <div class="">
        @yield('content')
    </div>
    <!-- responsive main layout END -->
    @include('layout.footer')

    @include( 'layout.scripts' )
    @yield('custom-scripts')

