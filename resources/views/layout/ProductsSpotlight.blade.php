<div class="row ">
    <div class="col-md-12 col-sm-12 px-0 pb-5">
      <div class="container-fluid">
        <h2 class=" fw-bold fs-1">Products Spotlight</h2>

                <!-- Spot ligth Slider  -->
                <div id="carousel-second" class="carousel slide carousel-fade" data-bs-ride="true">
                    <div class="carousel-indicators">
                        {{-- @foreach ($spotlightProducts as $index => $mainSlide)
                            <button type="button" data-bs-target="#carousel-second" data-bs-slide-to="{{ $index }}" {!! $index == 0 ? 'class="active" aria-current="true"' : '' !!} aria-label="Slide {{ $index+1 }}"></button>
                        @endforeach --}}
                    </div>
                    <div class="carousel-inner">
                        {{-- @foreach ($spotlightProducts as $index => $mainSlide)
                            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                <img src=" {{ $mainSlide->imageUrl }}" class="d-block w-100" alt="..." >
                            </div>
                        @endforeach --}}
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#carousel-second" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carousel-second" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <!-- Spot light Slider END -->
       {{-- <div id="carousel-second" class="carousel slide carousel-fade" data-bs-ride="true">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carousel-second" data-bs-slide-to="0" class="active"
            aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carousel-second" data-bs-slide-to="1"
            aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carousel-second" data-bs-slide-to="2"
            aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ asset('asset/img/spotlight.png') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('asset/img/spotlight.png') }}" class="d-block w-100" alt="...">
          </div>
          <div class="carousel-item">
            <img src="{{ asset('asset/img/spotlight.png') }}" class="d-block w-100" alt="...">
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-second" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-second" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div> --}}
      </div>
    </div>
  </div>
