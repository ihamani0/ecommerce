<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class=""> Featured Products </h3>

        </div>
        <div class="row">
            <div class="col-lg-3 d-none d-lg-flex wow animate__animated animate__fadeIn">
                <div class="banner-img style-2">
                    <div class="banner-text">
                        <h2 class="mb-100">Bring nature into your home</h2>
                        <a href="shop-grid-right.html" class="btn btn-xs">Shop Now <i class="fi-rs-arrow-small-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">

                                @foreach($Featured as $item)
                                {{--Strat Product wrap--}}
                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=> $item->products_uuid , 'slug' => $item->product_slug])}}">
                                                <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($item->product_thumbnail)}}"
                                                        alt="{{$item->product_slug}}" />
                                                {{--<img class="hover-img" src="{{asset("frontend/assets/imgs/shop/product-1-2.jpg")}}" alt="" />--}}
                                            </a>
                                        </div>
                                        <div class="product-action-1">

                                            {{--Quick view--}}
                                            <a aria-label="Quick view" class="action-btn small hover-up" data-uuid="{{ $item->products_uuid }}" onclick="fetchProduct(this)"
                                               data-bs-toggle="modal" data-bs-target="#quickViewModal">
                                                <i class="fi-rs-eye"></i></a>

                                            {{--wish list--}}
                                            <a aria-label="Add To Wishlist" class="action-btn small hover-up"
                                               data-id="{{$item->id}}" onclick="AddToWishList(this)">
                                                <i class="fi-rs-heart"></i></a>

                                            {{--Compare List--}}
                                            <a aria-label="Compare" class="action-btn"
                                               data-id="{{$item->id}}"  onclick="AddToCompareProducts(this)"
                                            ><i class="fi-rs-shuffle"></i></a>


                                        </div>
                                        <div class="product-badges product-badges-position product-badges-mrg">

                                            @if($item->discount_price)
                                                <span class="hot"> save {{ 100 - $item->discount_price  }}%</span> {{--sale new --}}
                                            @else
                                                <span class="new">new</span>
                                            @endif


                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$item->products_uuid , 'slug'=>$item->product_slug ] )}}">
                                                {{$item->category->category_name}}</a>
                                        </div>
                                        <h2><a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$item->products_uuid , 'slug'=>$item->product_slug ] )}}">
                                                {{$item->product_name}}</a></h2>

                                        {{--Rating--}}

                                        <div class="product-rate d-inline-block">
                                            @switch($item->avgRating())
                                                @case(1 || $item->avgRating() < 2 ) <div class="product-rating" style="width: 20%"></div> @break
                                                @case( 2 || $item->avgRating() < 3)  <div class="product-rating" style="width: 40%"></div> @break
                                                @case(3 || $item->avgRating() < 4)  <div class="product-rating" style="width: 60%"></div> @break
                                                @case(4 || $item->avgRating() < 5)  <div class="product-rating" style="width: 80%"></div>@break
                                                @case(5) <div class="product-rating" style="width: 100%"></div> @break
                                                @default <div class="product-rating" style="width: 2%"></div> @break
                                            @endswitch

                                        </div>



                                        <div class="product-price mt-10">

                                            @if($item->discount_price)
                                                <span> {{ ($item->selling_price * $item->discount_price) / 100 }} Dz</span>
                                                <span class="old-price">{{$item->selling_price }} Dz</span>
                                            @else
                                                <span >{{$item->selling_price }} Dz</span>
                                            @endif

                                        </div>
                                        <div class="sold mt-15 mb-15">
                                            <div class="progress mb-5">
                                                <div class="progress-bar" role="progressbar" style="width: {{50}}%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="font-xs text-heading"> Sold: 60/120</span>
                                        </div>
                                        @if($item->product_Qty > 0 )
                                            <a class="btn w-100 hover-up" data-uuid="{{$item->products_uuid}}" onclick="addToCart(this)">
                                                <i class="fi-rs-shopping-cart mr-5"></i>Add To Cart</a>
                                        @endif

                                    </div>
                                </div>
                                <!--End product Wrap-->
                                @endforeach



                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->


                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>
{{--

@push('script')
    <script>

    </script>
@endpush
--}}
