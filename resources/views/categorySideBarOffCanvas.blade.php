<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">Shop By Category</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body" id="shop-by-category-canvas" >


        <div class="row my-3 px-3 d-flex justify-content-center flex-column align-items-center sidebar-footer " style=" overflow-x: hidden;     position: absolute; bottom: 0% !important;" >
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
</div>
