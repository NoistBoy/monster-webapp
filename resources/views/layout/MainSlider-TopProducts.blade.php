<div class="row">
    <div class="col-md-12 col-sm-12 carousel-main-container">
      <div id="carousel-main" class="carousel slide carousel-fade" data-bs-ride="true">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carousel-main" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carousel-main" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carousel-main" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src=" {{ asset('asset/img/slider-1.jpg') }}" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
          </div>
          <div class="carousel-item">
            <img src=" {{ asset('asset/img/slider-1.jpg') }}" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
          </div>
          <div class="carousel-item">
            <img src=" {{ asset('asset/img/slider-1.jpg') }}" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-main" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-main" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      <div>
        <h2 class="fw-bold mt-5">Top 5 Products</h2>
      </div>
      <div class="row">
        <div class="col-12 my-3 btn-tag-wrapper">
          <button class="btn btn-tag top-5-products" data-src="" >Flower</button>
          <button class="btn btn-tag top-5-products" data-src="" >Torches</button>
          <button class="btn btn-tag top-5-products" data-src="" >Kratom</button>
          <button class="btn btn-tag top-5-products" data-src="" >Disposable</button>
          <button class="btn btn-tag top-5-products" data-src="" >Cartridge</button>
        </div>
      </div>
      <div>
        <img src="{{ asset('asset/img/sub-slide.jpg') }}" alt="image" class="img-fluid" style="border-radius: 0 0 25px 25px;" >
      </div>
    </div>
  </div>
