
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

                                    {{--Add to wish List--}}
                                    <a aria-label="Add To Wishlist" class="action-btn"
                                       data-id="{{$product->id}}" onclick="AddToWishList(this)">
                                        <i class="fi-rs-heart"></i></a>

                                    {{--Add to Compare List--}}
                                    {{--Compare List--}}
                                    <a aria-label="Compare" class="action-btn"
                                       data-id="{{$product->id}}"  onclick="AddToCompareProducts(this)"
                                    ><i class="fi-rs-shuffle"></i></a>

                                    {{--QuickView--}}
                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                       data-uuid="{{ $product->products_uuid }}" onclick="fetchProduct(this)">
                                        <i class="fi-rs-eye"></i></a>
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


                                    {{--Rating--}}
                                    <div class="product-rate d-inline-block">
                                        @switch($product->avgRating())
                                            @case(1 || $product->avgRating() < 2 ) <div class="product-rating" style="width: 20%"></div> @break
                                            @case( 2 || $product->avgRating() < 3)  <div class="product-rating" style="width: 40%"></div> @break
                                            @case(3 || $product->avgRating() < 4)  <div class="product-rating" style="width: 60%"></div> @break
                                            @case(4 || $product->avgRating() < 5)  <div class="product-rating" style="width: 80%"></div>@break
                                            @case(5) <div class="product-rating" style="width: 100%"></div> @break
                                            @default <div class="product-rating" style="width: 2%"></div> @break
                                        @endswitch

                                    </div>


                                    {{--Start Rate--}}
                                    <span class="font-small ml-5 text-muted"> ({{$product->avgRating()}})</span>
                                </div>
                                <div>
                                    @if($product->vendor_id)
                                        <span class="font-small text-muted">By
                                            <a href="{{route(\App\Constants\Constants::WEB_Vendor_Details,$product->vendor->id)}}">
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
                                    @if($product->product_Qty > 0 )

                                    @endif
                                    <div class="add-cart">
                                        <a data-uuid="{{$product->products_uuid}}" onclick="addToCart(this)"
                                           class="btn btn-sm"><i class="fi-rs-shopping-bag mr-5"></i>Add</a>
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
