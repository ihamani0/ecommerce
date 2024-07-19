@extends("frontend.layout.master")



@section("main")

    <div class="page-header mt-30 mb-50">
        <div class="container">
            <div class="archive-header">
                <div class="row align-items-center">
                    <div class="col-xl-3">
                        <h1 class="mb-15">{{$category->category_name}}</h1>
                        <div class="breadcrumb">
                            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                            <span></span> Shop <span></span> {{$category->category_name}}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <div class="container mb-30">
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{count($category->products)}}</strong> items for you!</p>
                    </div>

                    {{--sort-by-product--}}
                    {{--<div class="sort-by-product-area">
                        <div class="sort-by-cover mr-10">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps"></i>Show:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> 50 <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">50</a></li>
                                    <li><a href="#">100</a></li>
                                    <li><a href="#">150</a></li>
                                    <li><a href="#">200</a></li>
                                    <li><a href="#">All</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="sort-by-cover">
                            <div class="sort-by-product-wrap">
                                <div class="sort-by">
                                    <span><i class="fi-rs-apps-sort"></i>Sort by:</span>
                                </div>
                                <div class="sort-by-dropdown-wrap">
                                    <span> Featured <i class="fi-rs-angle-small-down"></i></span>
                                </div>
                            </div>
                            <div class="sort-by-dropdown">
                                <ul>
                                    <li><a class="active" href="#">Featured</a></li>
                                    <li><a href="#">Price: Low to High</a></li>
                                    <li><a href="#">Price: High to Low</a></li>
                                    <li><a href="#">Release Date</a></li>
                                    <li><a href="#">Avg. Rating</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>--}}
                </div>

                <div class="row product-grid">
                    @foreach($category->products()->paginate(10) as $product)
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="" />
                                    </a>
                                </div>
                                <div class="product-action-1">

                                    {{--Wishlist--}}
                                    <a aria-label="Add To Wishlist" class="action-btn"
                                       data-id="{{$product->id}}" onclick="AddToWishList(this)"
                                    ><i class="fi-rs-heart"></i></a>

                                    {{--Compare List--}}
                                    <a aria-label="Compare" class="action-btn"
                                       data-id="{{$product->id}}"  onclick="AddToCompareProducts(this)"
                                    ><i class="fi-rs-shuffle"></i></a>

                                    {{--Quick view Button--}}
                                    <a aria-label="Quick view" data-uuid="{{ $product->products_uuid }}" onclick="fetchProduct(this)"
                                       class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i>
                                    </a>
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
                                        {{$category->category_name}}</a>
                                </div>
                                <h2><a href="shop-product-right.html">{{$product->product_name}}</a></h2>
                                <div class="product-rate-cover">


                                    <div class="product-rate d-inline-block">
                                        @if($product->avgRating() == 0)
                                            <div class="product-rating" style="width: 0%"></div>
                                        @elseif($product->avgRating() < 1)
                                            <div class="product-rating" style="width: 10%"></div>
                                        @elseif($product->avgRating() < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($product->avgRating() < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($product->avgRating() < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($product->avgRating() < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @else
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif

                                    </div>
                                    {{--Start Rate--}}
                                    <span class="font-small ml-5 text-muted"> ({{ count($product->comments) }} reviews) </span>

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
                                        <div class="add-cart">
                                            <a data-uuid="{{$product->products_uuid}}" onclick="addToCart(this)"
                                               class="add"><i class="fi-rs-shopping-bag mr-5"></i>Add</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @endforeach
                </div>

                <!--product grid-->
                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        {{ $category->products()
                                        ->paginate(10)
                                            ->links('frontend.pages.vendor.paginate') }}
                    </nav>
                </div>

                <!--End Deals-->


            </div>
            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach($Categories as $category)
                         <li>
                            <a href="shop-grid-right.html">
                                <img src="{{\Illuminate\Support\Facades\Storage::url($category->category_img)}}" alt="" />
                                {{$category->category_name}}</a>
                             <span class="count">{{count($category->products)}}</span>
                         </li>
                         @endforeach
                    </ul>
                </div>

                <!-- Fillter By Price -->
                    {{--<div class="sidebar-widget price_range range mb-30">
                        <h5 class="section-title style-1 mb-30">Fill by price</h5>
                        <div class="price-filter">
                            <div class="price-filter-inner">
                                <div id="slider-range" class="mb-20"></div>
                                <div class="d-flex justify-content-between">
                                    <div class="caption">From: <strong id="slider-range-value1" class="text-brand"></strong></div>
                                    <div class="caption">To: <strong id="slider-range-value2" class="text-brand"></strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="list-group">
                            <div class="list-group-item mb-10 mt-10">
                                <label class="fw-900">Color</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox1" value="" />
                                    <label class="form-check-label" for="exampleCheckbox1"><span>Red (56)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox2" value="" />
                                    <label class="form-check-label" for="exampleCheckbox2"><span>Green (78)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox3" value="" />
                                    <label class="form-check-label" for="exampleCheckbox3"><span>Blue (54)</span></label>
                                </div>
                                <label class="fw-900 mt-15">Item Condition</label>
                                <div class="custome-checkbox">
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox11" value="" />
                                    <label class="form-check-label" for="exampleCheckbox11"><span>New (1506)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox21" value="" />
                                    <label class="form-check-label" for="exampleCheckbox21"><span>Refurbished (27)</span></label>
                                    <br />
                                    <input class="form-check-input" type="checkbox" name="checkbox" id="exampleCheckbox31" value="" />
                                    <label class="form-check-label" for="exampleCheckbox31"><span>Used (45)</span></label>
                                </div>
                            </div>
                        </div>
                        <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                    </div>--}}
                <!-- Product sidebar Widget -->

                <div class="sidebar-widget product-sidebar mb-30 p-30 bg-grey border-radius-10">
                    <h5 class="section-title style-1 mb-30">New products</h5>

                    @foreach($Products->take(3) as $product)

                    <div class="single-post clearfix">
                        <div class="image">
                            <img src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="#" />
                        </div>
                        <div class="content pt-10">
                            <h5><a href="{{route(App\Constants\Constants::WEB_Products_Details ,["uuid" => $product->products_uuid ,
                                                        "slug"=>  $product->product_slug])}}">
                                    {{$product->product_name}}</a></h5>
                            @if($product->discount_price)
                                <p class="price mb-0 mt-5"> {{ ($product->selling_price * $product->discount_price) / 100 }} Dz</p>
                                <p class="old-price price mb-0 mt-5">{{$product->selling_price }} Dz</p>
                            @else
                                <p class="price mb-0 mt-5" >{{$product->selling_price }} Dz</p>
                            @endif

                            {{--<div class="product-rate">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>--}}
                        </div>
                    </div>
                    @endforeach
                </div>
                {{--<div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                    <img src="assets/imgs/banner/banner-11.png" alt="" />
                    <div class="banner-text">
                        <span>Oganic</span>
                        <h4>
                            Save 17% <br />
                            on <span class="text-brand">Oganic</span><br />
                            Juice
                        </h4>
                    </div>
                </div>--}}

            </div>
        </div>
    </div>

@endsection
