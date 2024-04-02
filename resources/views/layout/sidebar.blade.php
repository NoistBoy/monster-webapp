<div class="sidebar" style="margin-top: 90px;">
    <div class="row">
        <div class="col-12">
            <div class="tree-list-wrapper mt-5 d-flex justify-content-center flex-column">
                <h5 class="fw-bold d-flex align-items-center "><i class="lni lni-menu"></i> &nbsp;&nbsp;<span>Shop by
                        Categories</span></h5>
                <!-- Tree List -->
                {!! $categoryTreeView !!}
                {{-- <ul id="category-list">
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="smoke">
                        <span class="">Smoke</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="vape">
                        <span class="">Vape</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="hookah">
                        <span class="">Hookah</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="cbd">
                        <span class="">Cbd</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="delta">
                        <span class="">Delta</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="kratom">
                        <span class="">Kratom</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="dispensary">
                        <span class="">Dispensary</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="adult-novelty">
                        <span class="">Adult Novelty</span><i class="lni lni-chevron-right"></i>
                    </li>
                    <li class="mb-2 label d-flex justify-content-between align-items-center" id="mushrooms">
                        <span class="">Mushrooms</span><i class="lni lni-chevron-right"></i>
                    </li>
                </ul>

                <div class="list-values" id="smoke-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cart Batteries</a></span>
                    <span class="d-flex align-items-center"><a href="#">Wax Devices</a></span>
                    <span class="d-flex align-items-center"><a href="#">E-Juice</a></span>
                    <span class="d-flex align-items-center"><a href="#">E-Cigs</a></span>
                    <span class="d-flex align-items-center"><a href="#">Mods/Kits</a></span>
                    <span class="d-flex align-items-center"><a href="#">Dry Herb Devices</a></span>
                    <span class="d-flex align-items-center"><a href="#">Tobacco-Free Nicotine</a></span>
                </div>
                <div class="list-values" id="vape-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables</a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower</a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                </div>
                <div class="list-values" id="hookah-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">All Delta</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables </a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Prerolls</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower </a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                    <span class="d-flex align-items-center"><a href="#">Edibles </a></span>
                </div>
                <div class="list-values" id="cbd-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">All Delta</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables </a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Prerolls</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower </a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                    <span class="d-flex align-items-center"><a href="#">Edibles </a></span>
                </div>
                <div class="list-values" id="delta-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">All Delta</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables </a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Prerolls</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower </a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                    <span class="d-flex align-items-center"><a href="#">Edibles </a></span>
                </div>
                <div class="list-values" id="kratom-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">All Delta</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables </a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Prerolls</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower </a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                    <span class="d-flex align-items-center"><a href="#">Edibles </a></span>
                </div>
                <div class="list-values" id="dispensary-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">All Delta</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables </a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Prerolls</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower </a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                    <span class="d-flex align-items-center"><a href="#">Edibles </a></span>
                </div>
                <div class="list-values" id="adult-novelty-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">All Delta</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables </a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Prerolls</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower </a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                    <span class="d-flex align-items-center"><a href="#">Edibles </a></span>
                </div>
                <div class="list-values" id="mushrooms-list">
                    <span class="d-flex align-items-center back-to-category"><i
                            class="lni lni-chevron-left"></i>&nbsp;&nbsp;&nbsp;<a href="#"> Back to
                            Home</a></span>
                    <span class="d-flex align-items-center"><a href="#">All Delta</a></span>
                    <span class="d-flex align-items-center"><a href="#">Disposables </a></span>
                    <span class="d-flex align-items-center"><a href="#">Gummies </a></span>
                    <span class="d-flex align-items-center"><a href="#">Prerolls</a></span>
                    <span class="d-flex align-items-center"><a href="#">Cartridges</a></span>
                    <span class="d-flex align-items-center"><a href="#">Flower </a></span>
                    <span class="d-flex align-items-center"><a href="#">Pod Systems</a></span>
                    <span class="d-flex align-items-center"><a href="#">Concentrate</a></span>
                    <span class="d-flex align-items-center"><a href="#">Edibles </a></span>
                </div> --}}
                <!-- Tree List End -->

            </div>
        </div>

    </div>
</div>
