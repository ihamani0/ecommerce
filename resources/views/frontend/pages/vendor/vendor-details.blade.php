@extends("frontend.layout.master")

@push('style')
    <link rel="stylesheet" href="{{asset('frontend/assets/css/plugins/slider-range.css')}}" />
@endpush


@section("main")

    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route(\App\Constants\Constants::WELCOME)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Store <span></span> {{$vendor->username}}
            </div>
        </div>
    </div>
    <div class="container mb-30">
        <div class="archive-header-2 text-center pt-80 pb-50">
            <h1 class="display-2 mb-50">{{$vendor->username}} Store</h1>

        </div>
        <div class="row flex-row-reverse">
            <div class="col-lg-4-5">
                <div class="shop-product-fillter">
                    <div class="totall-product">
                        <p>We found <strong class="text-brand">{{count($vendor->products)}}</strong> items for you!</p>
                    </div>

                    {{--Fillter--}}
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
                    @foreach($vendor->products()->paginate(20) as $product)

                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="" />

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
                                <h2><a  href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        {{$product->product_name}}</a></h2>
                                <div class="product-rate-cover">
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div>
                                    <span class="font-small text-muted">By <a href="vendor-details-1.html">{{$vendor->username}}</a></span>
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
                <!--product grid-->


                <div class="pagination-area mt-20 mb-20">
                    <nav aria-label="Page navigation example">
                        {{ $vendor->products()
                                    ->paginate(20)
                                        ->links('frontend.pages.vendor.paginate') }}
                    </nav>
                </div>

                <!--End Deals-->
            </div>

            <div class="col-lg-1-5 primary-sidebar sticky-sidebar">
                <div class="sidebar-widget widget-store-info mb-30 bg-3 border-0">
                    <div class="vendor-logo mb-30">
                        @if($vendor->photo_profile)
                            <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($vendor->photo_profile)}}" alt="" />
                        @else
                            <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url('public/upload/no-image.svg')}}" alt=""
                                 width="70px" height="70px"/>
                        @endif
                    </div>
                    <div class="vendor-info">
                        <div class="product-category">
                            @if($vendor->created_at)
                                <span class="text-muted">Since {{$vendor->created_at?->format('Y')}}</span>
                            @endif
                        </div>
                        <h4 class="mb-5"><a href="{{route(\App\Constants\Constants::WEB_Vendor_Details,$vendor->id)}}">
                                {{$vendor->username}}</a>
                        </h4>

                        <div class="product-rate-cover mb-15">
                            <div class="product-rate d-inline-block">
                                <div class="product-rating" style="width: 90%"></div>
                            </div>
                            <span class="font-small ml-5 text-muted"> (4.0)</span>
                        </div>
                        <div class="vendor-des mb-30">
                            <p class="font-sm text-heading">
                                {{$vendor->description}}
                            </p>
                        </div>

                        {{--Socail media--}}
                        {{--<div class="follow-social mb-20">
                            <h6 class="mb-15">Follow Us</h6>
                            <ul class="social-network">
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="assets/imgs/theme/icons/social-tw.svg" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="assets/imgs/theme/icons/social-fb.svg" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="assets/imgs/theme/icons/social-insta.svg" alt="" />
                                    </a>
                                </li>
                                <li class="hover-up">
                                    <a href="#">
                                        <img src="assets/imgs/theme/icons/social-pin.svg" alt="" />
                                    </a>
                                </li>
                            </ul>
                        </div>--}}

                        <div class="vendor-info">
                            <ul class="font-sm mb-20">
                                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-location.svg" alt="" /><strong>Address: </strong> <span>{{$vendor->street_address??"N/A"}}</span></li>
                                <li><img class="mr-5" src="assets/imgs/theme/icons/icon-contact.svg" alt="" /><strong>Call Us:</strong><span>(+213) - {{$vendor->phone_number??"N/A"}}</span></li>
                            </ul>
                            <a href="vendor-details-1.html" class="btn btn-xs">Contact Seller <i class="fi-rs-arrow-small-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-widget widget-category-2 mb-30">
                    <h5 class="section-title style-1 mb-30">Category</h5>
                    <ul>
                        @foreach($Categories as $category)
                            <li>
                                <a href="shop-grid-right.html"> <img src="assets/imgs/theme/icons/category-1.svg" alt="" />{{$category->category_name}}</a>
                                <span class="count">{{count($category->products)}}</span>
                            </li>
                        @endforeach

                    </ul>
                </div>


                {{--Filter--}}
                {{--<!-- Fillter By Price -->
                <div class="sidebar-widget price_range range mb-30">
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

                        </div>
                    </div>
                    <a href="shop-grid-right.html" class="btn btn-sm btn-default"><i class="fi-rs-filter mr-5"></i> Fillter</a>
                </div>

                <div class="banner-img wow fadeIn mb-lg-0 animated d-lg-block d-none">
                    <img src="{{asset('frontend/assets/imgs/banner/banner-11.png')}}" alt="" />
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

