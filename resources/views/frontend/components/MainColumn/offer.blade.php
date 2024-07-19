<section class="section-padding mb-30">
    <div class="container">
        <div class="row">

            {{--Hot deals--}}
            <div class="col-xl-3 col-lg-3 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($HotDeals->take(3) as $product)
                    <article class="row align-items-center hover-up">
                        <figure class="col-md-4 mb-0">
                            <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="" />
                        </figure>
                        <div class="col-md-8 mb-0">
                            <h6>
                                <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                    {{$product->category->category_name}}</a>
                            </h6>
                            <div class="product-rate-cover">
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
                            <div class="product-price">
                                @if($product->discount_price)
                                    <span> {{ ($product->selling_price * $product->discount_price) / 100 }} Dz</span>
                                    <span class="old-price">{{$product->selling_price }} Dz</span>
                                @else
                                    <span >{{$product->selling_price }} Dz</span>
                                @endif
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

            {{--Special Offer--}}
            <div class="col-xl-3 col-lg-3 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated">  Special Offer </h4>
                <div class="product-list-small animated animated">


                    @foreach($SpecialOffer->take(3) as $product)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                    <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="" />
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        {{$product->category->category_name}}</a>
                                </h6>
                                <div class="product-rate-cover">

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
                                <div class="product-price">
                                    @if($product->discount_price)
                                        <span> {{ ($product->selling_price * $product->discount_price) / 100 }} Dz</span>
                                        <span class="old-price">{{$product->selling_price }} Dz</span>
                                    @else
                                        <span >{{$product->selling_price }} Dz</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach

                </div>
            </div>

            {{--Special Deals--}}
            <div class="col-xl-3 col-lg-3  col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">
                    @foreach($SpecialDeals->take(3) as $product)
                        <article class="row align-items-center hover-up">
                            <figure class="col-md-4 mb-0">
                                <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                    <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="" />
                            </figure>
                            <div class="col-md-8 mb-0">
                                <h6>
                                    <a href="{{route(\App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=>$product->product_slug ] )}}">
                                        {{$product->category->category_name}}</a>
                                </h6>
                                <div class="product-rate-cover">


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

                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
                                </div>
                                <div class="product-price">
                                    @if($product->discount_price)
                                        <span> {{ ($product->selling_price * $product->discount_price) / 100 }} Dz</span>
                                        <span class="old-price">{{$product->selling_price }} Dz</span>
                                    @else
                                        <span >{{$product->selling_price }} Dz</span>
                                    @endif
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
