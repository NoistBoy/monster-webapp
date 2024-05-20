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
    <script>
        // get categories
        document.addEventListener("DOMContentLoaded", function() {

            getCategories()
            .then(categories => {
                var categoryFinalview = getCategoryTreeView(categories.result);
                if($('#shop-by-category-canvas')){
                    $('#shop-by-category-canvas').append(categoryFinalview);
                }
                if($('.tree-list-wrapper')){
                    $('.tree-list-wrapper').append(categoryFinalview);
                }

            })
            .catch(error => {
                console.error('Error fetching categories:', error);
            });


        });


        function getCategories() {
            const url = 'https://erp.monstersmokewholesale.com/api/menu?businessTypeId=1';

            return fetch(url, {
                method: 'GET'
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
        }

        function getCategoryTreeView(categories) {

            let categoryLabels = '';
            let categoryLists = '';

            categories.forEach(category => {
                const categoryName = category.name.replace(/\s/g, '');
                const categoryId = category.id;

                // Construct category labels
                categoryLabels += `<li class="mb-2 label d-flex justify-content-between align-items-center" id="${categoryId}" onClick="showCategoryList(this)">
                                        <span>${categoryName}</span><i class="lni lni-chevron-right"></i>
                                    </li>`;

                // Construct category lists
                categoryLists += `<div class="list-values ${categoryId}-list" id="${categoryId}-list">
                                        <span class="d-flex align-items-center back-to-category"><i class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to Home</a></span>`;

                if (category.subCategories && category.subCategories.length > 0) {
                    category.subCategories.forEach(subCategory => {
                        const subCategoryHref = `/category-products/${categoryName.toLowerCase()}/${subCategory.name.toLowerCase().replace(/\//g, '-').replace(/\s/g, '-')}/${subCategory.id}`;
                        categoryLists += `<a href="${subCategoryHref}" id="${subCategory.id}" data-parent_id="${categoryId}">
                                                <span class="d-flex align-items-center">${subCategory.name}</span>
                                            </a>`;
                    });
                }

                categoryLists += `</div>`;
            });

            const categoryTreeView = `<ul id="category-list">${categoryLabels}</ul>${categoryLists}`;
            return categoryTreeView;
        }

        function showCategoryList(element) {

            var id = element.id;
            var categoryList = $(element).closest('#category-list');
            categoryList.hide();
            // var listValuesToShow = $('#' + id + '-list');
            var listValuesToShow = $('.' + id + '-list');
            listValuesToShow.fadeIn();

            listValuesToShow.on('click', '.back-to-category', function () {
                categoryList.fadeIn();
                listValuesToShow.hide();
            });
        }


    </script>
    @yield('custom-scripts')

