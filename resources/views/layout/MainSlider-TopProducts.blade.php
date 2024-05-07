<div class="row">
    <div class="col-md-12 col-sm-12 carousel-main-container">
        <!-- Main Slider  -->
        <div id="carousel-main" class="carousel slide carousel-fade" data-bs-ride="true">
            <div class="carousel-indicators">
                {{-- @foreach ($mainSlides as $index => $mainSlide)
                    <button type="button" data-bs-target="#carousel-main" data-bs-slide-to="{{ $index }}" {!! $index == 0 ? 'class="active" aria-current="true"' : '' !!} aria-label="Slide {{ $index+1 }}"></button>
                @endforeach --}}
            </div>
            <div class="carousel-inner">
                {{-- @foreach ($mainSlides as $index => $mainSlide)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src=" {{ $mainSlide->imageUrl }}" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
                    </div>
                @endforeach --}}
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
        <!-- Main Slider END -->
      <div>
        <h2 class="fw-bold mt-5 top-five-product">Top 5 Products</h2>
      </div>
      <div class="row d-none">
        <div class="col-12 my-3 btn-tag-wrapper">
          <button class="btn btn-tag top-5-products" data-src="" >Flower</button>
          <button class="btn btn-tag top-5-products" data-src="" >Torches</button>
          <button class="btn btn-tag top-5-products" data-src="" >Kratom</button>
          <button class="btn btn-tag top-5-products" data-src="" >Disposable</button>
          <button class="btn btn-tag top-5-products" data-src="" >Cartridge</button>
        </div>
      </div>
        <!-- Main Slider  -->
        <div id="top-five-product-caroucel" class="carousel slide carousel-fade" data-bs-ride="true">
            <div class="carousel-indicators">
                {{-- @foreach ($TopFiveProductSlides as $index => $TopFiveProductSlide)
                    <button type="button" data-bs-target="#top-five-product-caroucel" data-bs-slide-to="{{ $index }}" {!! $index == 0 ? 'class="active" aria-current="true"' : '' !!} aria-label="Slide {{ $index+1 }}"></button>
                @endforeach --}}
            </div>
            <div class="carousel-inner">
                {{-- @foreach ($TopFiveProductSlides as $index => $TopFiveProductSlide)
                    <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                        <img src=" {{ $TopFiveProductSlide->imageUrl }}" class="d-block w-100" alt="..." style="border-radius: 0 0 25px 25px;">
                    </div>
                @endforeach --}}
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#top-five-product-caroucel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#top-five-product-caroucel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <!-- Main Slider END -->
      {{-- <div>
        <img src="{{ asset('asset/img/sub-slide.jpg') }}" alt="image" class="img-fluid" style="border-radius: 0 0 25px 25px;" >
      </div> --}}
    </div>
  </div>
