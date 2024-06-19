
@foreach($MaxCategories as $category)


<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3>{{$category->category_name}}</h3>

        </div>
        <!--End nav-tabs-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">


                    @foreach($category->products->take(10) as $product)


                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="" />
                                        <img class="hover-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($product->discount_price)
                                        <span class="best">-{{ 100 - $product->discount_price  }}%</span> {{--sale new --}}
                                    @else
                                        <span class="new">new</span>
                                    @endif
                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        {{$product->category->category_name}}</a>
                                </div>
                                <h2><a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        {{$product->short_description}}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    @if($product->vendor_id)
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">
                                                    {{$product->vendor->username}}
                                                </a></span>
                                    @else
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">
                                                    Ecomme
                                                </a></span>
                                    @endif
                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        @if($product->discount_price)
                                            <span> {{ ($product->selling_price * $product->discount_price) / 100 }} Dz</span>
                                            <span class="old-price">{{$product->selling_price }} Dz</span>
                                        @else
                                            <span >{{$product->selling_price }} Dz</span>
                                        @endif
                                    </div>
                                    <div class="add-cart">
                                        <a class="add" href="shop-cart.html"><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->

                    @endforeach



                </div>
                <!--End product-grid-4-->
            </div>


        </div>
        <!--End tab-content-->
    </div>


</section>



@endforeach
