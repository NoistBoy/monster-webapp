
<div class="sidebar">
    <h6 class="fw-bold d-flex align-items-center mb-3 shop-by-categoy">
        {{-- <i class="lni lni-menu"></i>  --}}
        <span>Shop&nbsp;by&nbsp;Categories</span>
    </h6>
    <div class="row shop-by-category-sidebar" style="height: 73vh; overflow-x: hidden;">
        <div class="col-12">
            <div class="tree-list-wrapper d-flex justify-content-center flex-column">

                <!-- Tree List -->
                {{-- {!! $categoryTreeView !!} --}}
                <!-- Tree List End -->
            </div>
        </div>
    </div>
    <div class="row my-3 px-3 d-flex justify-content-center flex-column align-items-center sidebar-footer " style=" overflow-x: hidden;     position: absolute; bottom: 0px;" >
        @if (Session::has('user.accessToken'))
            <a href="{{ Url('/log-out') }}" class="btn-sidebar-footer mb-1" style="color: #FFFFFF;">
                Log Out&nbsp;&nbsp;<i class="fa-solid fa-right-from-bracket"></i>
            </a>
        @else
            <a href="{{ Url('/sign-up') }}" class="btn-sidebar-footer mb-1" style="color: #FFFFFF;">
                Join Monster Smoke
            </a>
        @endif
        <small class="text-center fw-bold text-secondary">Purchase on Monster Smoke is exclusive to members</small>
    </div>
</div>
