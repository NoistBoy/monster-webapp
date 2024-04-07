@extends('layout.layout')

@section('content')
    <div class="container-fluid" style="margin-top: 90px;">
        <div class="row">
            <div class="col-12">
                <nav class="mt-4 px-5 mb-2" aria-label="breadcrumb" style="padding-left: 2.5rem !important;">
                    <ol class="breadcrumbs">
                        <li><a href="{{ url('/') }}">HOME</a></li>
                        <li>{{ $category }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 px-5">
                <h1 class="mt-3 mb-3">{{ $subcategory }}</h1>
                <div class="row mb-3">
                    <div class="col-12 my-3 btn-tag-wrapper d-flex">
                        <button class="btn btn-tag top-5-products d-flex justify-content-center align-items-center"
                            data-src="">Flower&nbsp;&nbsp;<i class="lni lni-arrow-top-right fw-bold"></i></button>
                        <button class="btn btn-tag top-5-products d-flex justify-content-center align-items-center"
                            data-src="">Torches&nbsp;&nbsp;<i class="lni lni-arrow-top-right fw-bold"></i></button>
                        <button class="btn btn-tag top-5-products d-flex justify-content-center align-items-center"
                            data-src="">Kratom&nbsp;&nbsp;<i class="lni lni-arrow-top-right fw-bold"></i></button>
                        <button class="btn btn-tag top-5-products d-flex justify-content-center align-items-center"
                            data-src="">Disposable&nbsp;&nbsp;<i class="lni lni-arrow-top-right fw-bold"></i></button>
                        <button class="btn btn-tag top-5-products d-flex justify-content-center align-items-center"
                            data-src="">Cartridge&nbsp;&nbsp;<i class="lni lni-arrow-top-right fw-bold"></i></button>
                    </div>
                </div>

                <div class="product-section mb-3">
                    <div class="product-grid">
                        {!! $products !!}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('custom-scripts')
    <script>
        $(document).ready(function() {

            var categoryId = {{ $categoryId }};
            var category_list = $('#category-list');
            category_list.hide();

            var subCategory = $('#' + categoryId);
            var id = subCategory.data('parent_id');
            var list_values_to_show = $('#' + id + '-list');
            subCategory.parent().addClass('active-category');
            list_values_to_show.fadeIn();

            list_values_to_show.on('click', '.back-to-category', function() {
                category_list.fadeIn();
                list_values_to_show.hide();

            });

        });
    </script>
@endsection