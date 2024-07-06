<!-- Quick view -->
<div class="modal fade custom-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closeModal"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                        <div class="detail-gallery">

                            <!-- MAIN SLIDES -->
                            <img src=" " alt="product image" id="Product_img" />

                        </div>
                        <!-- End Gallery -->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info pr-30 pl-30">

                            <span class="" id="product_sale"> </span>

                            <h3 class="title-detail"><a href="" class="text-heading" id="product_name"></a></h3>



                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left" id="div_product_price">

                                    <span class="current-price text-brand" id="product_price"></span>
                                    <span>
                                            <span class="save-price font-md color3 ml-15" id="save_price"></span>
                                            <span class="old-price font-md ml-15" id="old_price"></span>
                                    </span>

                                </div>
                            </div>


                            {{--size --}}
                            <div class="mb-30 col" id="Parent_div_display_size">
                                <label class="form-label fs-6 fw-bold">Select Size</label>
                                <div class="" id="child_div_display_sizes">
                                    {{-- <label class="form-check form-check-inline" >
                                         {{-put type="checkbox" class="form-check-input" name="select_size[]" value="" id="value_size" >
                                         <div class="form-check-label fw-500" id="display_size"></div>
                                        </label>--}}
                                </div>
                            </div>

                            {{--color--}}
                            <div class="mb-30 col" id="Parent_div_display_color">
                                <label class="form-label fs-6 fw-bold">Select Color</label>
                                <div class="" id="child_div_display_color">
                                        {{--<label class="form-check form-check-inline" id="label_display_color">
                                            <input type="checkbox" class="form-check-input" name="select_color[]" value="" id="value_color" >
                                            <div class="form-check-label fw-500" id="value_color"></div>
                                        </label>--}}
                                </div>
                            </div>



                            {{--Hiddin inpute to set id Product--}}
                            <input type="hidden" id="product_uuid">
                            {{--Hiddin inpute to set id Vendor--}}
                            <input type="hidden" id="vendor_id">

                            <div class="detail-extralink mb-30">
                                <div class="detail-qty border radius">
                                    <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                    <input type="text" name="product_qty" class="qty-val" value="1" min="1" >
                                    <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                </div>
                                <div class="product-extra-link2">
                                    <button type="submit" class="button button-add-to-cart"
                                        onclick="addToCartQuickView()"><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                </div>
                            </div>
                            <div class="font-xs">
                                <ul>
                                    <li class="mb-5">Vendor: <span class="text-brand" id="vendor_name"></span></li>
                                    <li class="mb-5">Category:<span class="text-brand" id="category_name"></span></li>

                                </ul>
                                <ul>
                                    <li class="mb-5">tags: <span class="text-brand" id="tags"></span></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Detail Info -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
