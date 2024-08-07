<section class="product-tabs section-padding position-relative">
    <div class="container">
        <div class="section-title style-2 wow animate__animated animate__fadeIn">
            <h3> New Products </h3>

            <ul class="nav nav-tabs links" id="myTab" role="tablist">

                <!--En tab All-->
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="nav-tab-one" data-bs-toggle="tab" data-bs-target="#tab-one" type="button" role="tab" aria-controls="tab-one" aria-selected="true">All</button>
                </li>
                <!--En tab All-->

                <!--En tab each category-->
                @foreach($Categories as $item)
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="nav-tab-one" data-bs-toggle="tab"  href="#category{{$item->id}}"  {{--data-bs-target="#tab-one"--}}
                            type="button" role="tab" aria-controls="category{{$item->id}}" aria-selected="true">{{$item->category_name}}</button>
                </li>
                @endforeach
                <!--En tab each category-->

            </ul>
        </div>
        <!--End nav-tabs-->

        <!--tab All-->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab-one" role="tabpanel" aria-labelledby="tab-one">
                <div class="row product-grid-4">
                    @foreach($Products->take(20) as $item)
                    <!--start product card-->
                    <div class="col-lg-1-5 col-md-4 col-12 col-sm-6">
                        <div class="product-cart-wrap mb-30 wow animate__animated animate__fadeIn" data-wow-delay=".1s">
                            <div class="product-img-action-wrap">
                                <div class="product-img product-img-zoom">
                                    <a target="_blank" href="{{ route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$item->products_uuid , 'slug'=>$item->product_slug ]  ) }}">
                                        <img  class="default-img" src="{{ \Illuminate\Support\Facades\Storage::url($item->product_thumbnail) }}" alt="" />

                                    </a>
                                </div>
                                <div class="product-action-1">

                                    <a aria-label="Add To Wishlist" class="action-btn"
                                       data-id="{{$item->id}}" onclick="AddToWishList(this)"
                                    ><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn"
                                       data-id="{{$item->id}}"  onclick="AddToCompareProducts(this)"
                                    ><i class="fi-rs-shuffle"></i></a>

                                    {{--Quick view button--}}
                                    <a aria-label="Quick view" class="action-btn" data-uuid="{{ $item->products_uuid }}" onclick="fetchProduct(this)"
                                       data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-eye"></i></a>
                                </div>
                                <div class="product-badges product-badges-position product-badges-mrg">
                                    @if($item->discount_price)
                                        <span class="best">-{{ 100 - $item->discount_price  }}%</span> {{--sale new --}}
                                    @else
                                        <span class="new">new</span>
                                    @endif

                                </div>
                            </div>
                            <div class="product-content-wrap">
                                <div class="product-category">
                                    <a target="_blank" href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$item->products_uuid , 'slug'=>$item->product_slug ] )}}">{{$item->category->category_name}}</a>
                                </div>
                                <h2><a target="_blank" href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$item->products_uuid , 'slug'=>$item->product_slug ] )}}">{{$item->short_description}}</a></h2>
                                <div class="product-rate-cover">

                                    <div class="product-rate d-inline-block">
                                        @if($item->avgRating() == 0)
                                            <div class="product-rating" style="width: 0%"></div>
                                        @elseif($item->avgRating() < 1)
                                            <div class="product-rating" style="width: 10%"></div>
                                        @elseif($item->avgRating() < 2)
                                            <div class="product-rating" style="width: 20%"></div>
                                        @elseif($item->avgRating() < 3)
                                            <div class="product-rating" style="width: 40%"></div>
                                        @elseif($item->avgRating() < 4)
                                            <div class="product-rating" style="width: 60%"></div>
                                        @elseif($item->avgRating() < 5)
                                            <div class="product-rating" style="width: 80%"></div>
                                        @else
                                            <div class="product-rating" style="width: 100%"></div>
                                        @endif

                                    </div>
                                    {{--Start Rate--}}
                                    <span class="font-small ml-5 text-muted"> ({{ count($item->comments) }} reviews) </span>
                                </div>
                                <div>
                                    @if($item->vendor_id)
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">
                                                {{$item->vendor->username}}
                                            </a></span>
                                    @else
                                        <span class="font-small text-muted">By <a href="vendor-details-1.html">
                                                Ecomme
                                            </a></span>
                                    @endif

                                </div>
                                <div class="product-card-bottom">
                                    <div class="product-price">
                                        @if($item->discount_price)
                                        <span> {{ ($item->selling_price * $item->discount_price) / 100 }} Dz</span>
                                        @else
                                            <span >{{$item->selling_price }} Dz</span>
                                        @endif
                                    </div>
                                    @if($item->product_Qty > 0 )
                                        <div class="add-cart">
                                            <a aria-label="Quick view" class="add" data-uuid="{{ $item->products_uuid }}" onclick="fetchProduct(this)"
                                               data-bs-toggle="modal" data-bs-target="#quickViewModal"
                                            ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                        </div>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end product card-->
                    @endforeach
                </div>
                <!--End product-grid-4-->
            </div>
        <!--En tab All-->



            @foreach($Categories as $item)
                <!--tab each category-->
                <div class="tab-pane fade" id="category{{$item->id}}" role="tabpanel" aria-labelledby="category{{$item->id}}">
                    <div class="row product-grid-4">

                        @if($item->products->isNotEmpty())
                            @forelse($item->products as $product)
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
                                                    <a class="add" data-uuid="{{$product->products_uuid}}" onclick="addToCart(this)"
                                                    ><i class="fi-rs-shopping-cart mr-5"></i>Add </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                                <div>
                                    <h3 class="text-warning">No categories available.</h3>
                                </div>
                            @endforelse
                            <!--end product card-->
                        @endif
                    </div>
                </div>
                <!--En tab each category-->
            @endforeach
        </div>
        <!--End tab-content-->
    </div>
</section>


