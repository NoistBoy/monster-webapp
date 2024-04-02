@include('layout.header')

    <!-- custom navbar start -->
    @include('layout.navbar')
    <!-- custom navbar End -->

    <!-- responsive main layout  -->

    <div class="" style="margin-top:90px ">
        @yield('content')
    </div>
    <!-- responsive main layout END -->
    @include('layout.footer')

    @include( 'layout.scripts' )

