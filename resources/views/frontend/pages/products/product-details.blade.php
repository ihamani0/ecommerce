@extends("frontend.layout.master")



@section("main")
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> <a href="shop-grid-right.html">{{$Product->category->category_name}}</a> <span></span> {{$Product->subcategory->subcategory_name}}
            </div>
        </div>
    </div>

    <div class="container mb-30">
        <div class="row">
            <div class="col-xl-10 col-lg-12 m-auto">
                <div class="product-detail accordion-detail">
                    <div class="row mb-50 mt-30">
                        <div class="col-md-6 col-sm-12 col-xs-12 mb-md-0 mb-sm-5">
                            <div class="detail-gallery">
                                <span class="zoom-icon"><i class="fi-rs-search"></i></span>

                                <!-- MAIN SLIDES -->
                                <div class="product-image-slider">

                                    @foreach($Product->MultiplImg as $img)
                                        <figure class="border-radius-10">
                                            <img src="{{\Illuminate\Support\Facades\Storage::url($img->product_img_name)}}" alt="product image" />
                                        </figure>
                                    @endforeach


                                </div>
                                <!-- THUMBNAILS -->
                                <div class="slider-nav-thumbnails">
                                    @foreach($Product->MultiplImg as $img)
                                        <div><img src="{{\Illuminate\Support\Facades\Storage::url($img->product_img_name)}}" alt="product image" /></div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- End Gallery -->
                        </div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            <div class="detail-info pr-30 pl-30">

                                @if($Product->product_Qty > 0)
                                    <span class="stock-status in-stock"> In stock</span>
                                @else
                                    <span class="stock-status out-stock">Sale Off </span>
                                @endif



                                <h2 class="title-detail">{{$Product->product_name}}</h2>

                                <div class="product-detail-rating">
                                    <div class="product-rate-cover text-end">
                                        <div class="product-rate d-inline-block">
                                            <div class="product-rating" style="width: 90%"></div>
                                        </div>
                                        <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                    </div>
                                </div>
                                <div class="clearfix product-price-cover">
                                    <div class="product-price primary-color float-left">
                                        @if($Product->discount_price)
                                            <span class="current-price text-brand">{{ ($Product->selling_price * $Product->discount_price) / 100 }} Dz</span>
                                            <span>
                                                    <span class="save-price font-md color3 ml-15">{{100 - $Product->discount_price}}% Off</span>
                                                    <span class="old-price font-md ml-15">{{$Product->selling_price}} Dz</span>
                                            </span>
                                        @else
                                            <span class="current-price text-brand">{{$Product->selling_price}} Dz</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="short-desc mb-30">
                                    <p class="font-lg">
                                        {{$Product->short_description}}
                                    </p>
                                </div>

                                {{--Form for order --}}
                                    <form method="post">
                                        @csrf



                                        @if($Product->product_color)

                                                <div class="mb-30 col">
                                                    <label class="form-label fs-6 fw-bold">Select Color</label>
                                                    <div class="">
                                                        @foreach($Product->colors() as $color)
                                                            <label class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" name="select_colors[]" value="{{ $color }}" >
                                                                <div class="form-check-label fw-500">{{ ucwords($color) }}</div>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>

                                        @endif


                                        @if($Product->product_size)

                                            <div class="mb-30 col">
                                                <label class="form-label fs-6 fw-bold">Select Size</label>
                                                <div class="">
                                                    @foreach($Product->sizes() as $size)
                                                        <label class="form-check form-check-inline">
                                                            <input type="checkbox" class="form-check-input" name="select_sizes[]" value="{{ $size }}" >
                                                            <div class="form-check-label fw-500">{{ $size }}</div>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>

                                        @endif





                                    </form>

                                <div class="detail-extralink mb-50">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <input type="text" name="quantity" class="qty-val" value="1" min="1">
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <input type="hidden" id="Product_uuid" value="{{$Product->products_uuid }}"/>
                                    <div class="product-extra-link2">
                                        {{--Add to Cart--}}
                                        <button type="submit" class="button button-add-to-cart" onclick="addToCartDetails()"
                                        ><i class="fi-rs-shopping-cart"></i>Add to cart</button>
                                        {{--WishList--}}
                                        <a aria-label="Add To Wishlist" class="action-btn"
                                           data-id="{{$Product->id}}" onclick="AddToWishList(this)"
                                        ><i class="fi-rs-heart"></i></a>

                                        {{--Compare List--}}
                                        <a aria-label="Compare" class="action-btn"
                                           data-id="{{$Product->id}}"  onclick="AddToCompareProducts(this)"
                                        ><i class="fi-rs-shuffle"></i></a>

                                    </div>
                                </div>

                                <div class="font-xs">
                                    <ul class="mr-50 float-start">
                                        <li class="mb-5">Brand: <span class="text-brand">
                                                {{$Product?->brand?->brand_name ?? ''}}
                                            </span></li>
                                        <li class="mb-5">Category:<span class="text-brand"> {{$Product->category->category_name}}</span></li>
                                        <li>Subcategory: <span class="text-brand">{{$Product->subcategory->subcategory_name}}</span></li>
                                    </ul>

                                    <ul class="float-start">
                                        <li class="mb-5">Code: <a href="#">{{$Product->product_code}}</a></li>
                                        @if($Product->product_tags)
                                            <li class="mb-5">Tags:
                                            @foreach($Product->tags() as $tag)
                                                <a href="#" rel="tag">{{$tag}}</a>,
                                            @endforeach
                                            </li>

                                        @endif
                                        <li>Stock:<span class="in-stock text-brand ml-5">{{ $Product->product_Qty }} Items In Stock</span></li>
                                    </ul>

                                    <ul class="mr-50 float-start">

                                        @if($Product->vendor_id)
                                            <li class="mb-5">Vendor:
                                                <a href="{{route(\App\Constants\Constants::WEB_Vendor_Details,$Product->vendor->id)}}">
                                                    <span class="text-brand">{{$Product->vendor->username}}</span>
                                                </a>
                                            </li>
                                        @else
                                            <li class="mb-5">Owner: <span class="text-brand">Ecomme</span></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <!-- Detail Info -->
                        </div>
                    </div>


                    <div class="product-info">
                        <div class="tab-style3">
                            <ul class="nav nav-tabs text-uppercase">
                                <li class="nav-item">
                                    <a class="nav-link active" id="Description-tab" data-bs-toggle="tab" href="#Description">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Additional-info-tab" data-bs-toggle="tab" href="#Additional-info">Additional info</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" id="Vendor-info-tab" data-bs-toggle="tab" href="#Vendor-info">Vendor</a>
                                </li>



                                <li class="nav-item">
                                    <a class="nav-link" id="Reviews-tab" data-bs-toggle="tab" href="#Reviews">Reviews (3)</a>
                                </li>
                            </ul>
                            <div class="tab-content shop_info_tab entry-main-content">
                                <div class="tab-pane fade show active" id="Description">
                                    <div class="">
                                        {!! $Product->long_description !!}
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="Additional-info">
                                    <table class="font-md">
                                        <tbody>
                                        <tr class="stand-up">
                                            <th>Stand Up</th>
                                            <td>
                                                <p>35″L x 24″W x 37-45″H(front to back wheel)</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-wo-wheels">
                                            <th>Folded (w/o wheels)</th>
                                            <td>
                                                <p>32.5″L x 18.5″W x 16.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="folded-w-wheels">
                                            <th>Folded (w/ wheels)</th>
                                            <td>
                                                <p>32.5″L x 24″W x 18.5″H</p>
                                            </td>
                                        </tr>
                                        <tr class="door-pass-through">
                                            <th>Door Pass Through</th>
                                            <td>
                                                <p>24</p>
                                            </td>
                                        </tr>
                                        <tr class="frame">
                                            <th>Frame</th>
                                            <td>
                                                <p>Aluminum</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-wo-wheels">
                                            <th>Weight (w/o wheels)</th>
                                            <td>
                                                <p>20 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="weight-capacity">
                                            <th>Weight Capacity</th>
                                            <td>
                                                <p>60 LBS</p>
                                            </td>
                                        </tr>
                                        <tr class="width">
                                            <th>Width</th>
                                            <td>
                                                <p>24″</p>
                                            </td>
                                        </tr>
                                        <tr class="handle-height-ground-to-handle">
                                            <th>Handle height (ground to handle)</th>
                                            <td>
                                                <p>37-45″</p>
                                            </td>
                                        </tr>
                                        <tr class="wheels">
                                            <th>Wheels</th>
                                            <td>
                                                <p>12″ air / wide track slick tread</p>
                                            </td>
                                        </tr>
                                        <tr class="seat-back-height">
                                            <th>Seat back height</th>
                                            <td>
                                                <p>21.5″</p>
                                            </td>
                                        </tr>
                                        <tr class="head-room-inside-canopy">
                                            <th>Head room (inside canopy)</th>
                                            <td>
                                                <p>25″</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_color">
                                            <th>Color</th>
                                            <td>
                                                <p>Black, Blue, Red, White</p>
                                            </td>
                                        </tr>
                                        <tr class="pa_size">
                                            <th>Size</th>
                                            <td>
                                                <p>M, S</p>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="Vendor-info">
                                    <div class="vendor-logo d-flex mb-30">
                                        @if($Product->vendor_id)

                                            <img src="{{\Illuminate\Support\Facades\Storage::url($Product->vendor->photo_profile)}}" alt="" />
                                        @else
                                            <img src="{{\Illuminate\Support\Facades\Storage::url('public/upload/no-image.svg')}}" alt="" />
                                        @endif

                                        <div class="vendor-name ml-15">
                                            <h6>
                                                <a href="vendor-details-2.html">{{$Product->vendor?->username ?? "Ecomme"}}</a>
                                                {{--@if($Product->vendor_id)
                                                    <a href="vendor-details-2.html">{{$Product->vendor->username}}</a>
                                                @else
                                                    <a href="vendor-details-2.html">Ecomme</a>
                                                @endif--}}
                                            </h6>
                                            <div class="product-rate-cover text-end">
                                                <div class="product-rate d-inline-block">
                                                    <div class="product-rating" style="width: 90%"></div>
                                                </div>
                                                <span class="font-small ml-5 text-muted"> (32 reviews)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="contact-infor mb-50">
                                        <li><img src="{{asset('frontend/assets/imgs/theme/icons/icon-location.svg')}}" alt="" /><strong>Address: </strong> <span>{{$Product->vendor?->street_address?? "Ecomme"}}</span></li>
                                        <li><img src="{{asset('frontend/assets/imgs/theme/icons/icon-contact.svg')}}" alt="" /><strong>Contact Seller:</strong><span>{{$Product->vendor?->phone_number ?? "Ecomme"}}</span></li>
                                    </ul>
                                    <div class="d-flex mb-55">
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Rating</p>
                                            <h4 class="mb-0">92%</h4>
                                        </div>
                                        <div class="mr-30">
                                            <p class="text-brand font-xs">Ship on time</p>
                                            <h4 class="mb-0">100%</h4>
                                        </div>
                                        <div>
                                            <p class="text-brand font-xs">Chat response</p>
                                            <h4 class="mb-0">89%</h4>
                                        </div>
                                    </div>
                                    <p>{{$Product->vendor?->description ?? ""}}</p>
                                </div>

                                <div class="tab-pane fade" id="Reviews">
                                    <!--Comments-->
                                    <div class="comments-area">
                                        <div class="row">

                                            {{--Commont Her Review--}}

                                        </div>
                                    </div>
                                    <!--comment form-->
                                    <div class="comment-form">
                                        <h4 class="mb-15">Add a review</h4>
                                        <div class="product-rate d-inline-block mb-30"></div>
                                        <div class="row">
                                            <div class="col-lg-8 col-md-12">
                                                <form class="form-contact comment_form" action="#" id="commentForm">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea class="form-control w-100" name="comment" id="comment" cols="30" rows="9" placeholder="Write Comment"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="name" id="name" type="text" placeholder="Name" />
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="form-group">
                                                                <input class="form-control" name="email" id="email" type="email" placeholder="Email" />
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <input class="form-control" name="website" id="website" type="text" placeholder="Website" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <button type="submit" class="button button-contactForm">Submit Review</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row mt-60">
                        <div class="col-12">
                            <h2 class="section-title style-1 mb-30">Related products</h2>
                        </div>
                        <div class="col-12">
                            <div class="row related-products">
                                {{--Card Related Category--}}


                                @foreach($Product->getProductsInSameSubcategory() as $product)

                                <div class="col-lg-3 col-md-4 col-12 col-sm-6">
                                    <div class="product-cart-wrap hover-up">
                                        <div class="product-img-action-wrap">
                                            <div class="product-img product-img-zoom">
                                                <a href="{{route(App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=> $product->product_slug  ])}}" tabindex="0">
                                                    <img class="default-img" src="{{\Illuminate\Support\Facades\Storage::url($product->product_thumbnail)}}" alt="{{$product->product_slug}}" />
                                                    {{--<img class="hover-img" src="assets/imgs/shop/product-2-2.jpg" alt="" />--}}
                                                </a>
                                            </div>
                                            <div class="product-action-1">
                                                <a aria-label="Quick view" class="action-btn small hover-up" data-bs-toggle="modal" data-bs-target="#quickViewModal"><i class="fi-rs-search"></i></a>
                                                <a aria-label="Add To Wishlist" class="action-btn small hover-up" href="shop-wishlist.html" tabindex="0"><i class="fi-rs-heart"></i></a>
                                                <a aria-label="Compare" class="action-btn small hover-up" href="shop-compare.html" tabindex="0"><i class="fi-rs-shuffle"></i></a>
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
                                            <h2><a href="{{route(App\Constants\Constants::WEB_Products_Details , ['uuid'=>$product->products_uuid , 'slug'=> $product->product_slug  ])}}" tabindex="0">
                                                    {{$product->product_name}}</a></h2>
                                            <div class="rating-result" title="90%">
                                                <span> </span>
                                            </div>
                                            <div class="product-price">
                                                @if($product->discount_price)
                                                    <span> {{ ($product->selling_price * $product->discount_price) / 100 }} Dz</span>
                                                    <span class="old-price" >{{$product->selling_price }} Dz</span>
                                                @else
                                                    <span >{{$product->selling_price }} Dz</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @endforeach


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>

        function addToCartDetails(){
            let id =  $("#Product_uuid").val()


            let selectedColors = [];
            let selectedSizes = [];

            let  isColorVisible = {{ $Product->product_color ? 'true' : 'false' }};
            let isSizeVisible = {{$Product->product_size ? 'true' : 'false'}};



            let sizeChecked = isSizeVisible ? $('input[name="select_sizes[]"]:checked').length > 0 : true;
            let colorChecked = isColorVisible ? $('input[name="select_colors[]"]:checked').length > 0 : true;


            if (!sizeChecked ) {
                Toast.fire({
                    icon: "error",
                    title: 'Error',
                    text: 'Please select the size .'
                });
                return;
            }
            if(!colorChecked){
                Toast.fire({
                    icon: "error",
                    title: 'Error',
                    text: 'Please select the Color .'
                });
                return;
            }



            //Selected colors and value
            $('input[name="select_sizes[]"]:checked').each(function() {
                selectedSizes.push($(this).val());
            });

            $('input[name="select_colors[]"]:checked').each(function() {
                selectedColors.push($(this).val());
            });

            let product_qty = $('input[name="quantity"]').val();

            //send to save in cart session
            let baseUrl = '{{url('/Add-To-Cart')}}' ;
            let token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type:'POST',
                dataType:'json' ,
                url :baseUrl ,
                headers: {
                    'X-CSRF-TOKEN': token
                },
                data: {
                    "id" : id,
                    "colors" : selectedColors ,
                    "sizes" : selectedSizes ,
                    "qty" : product_qty
                } ,
                success : (response)=>{



                    if ($.isEmptyObject(response.error)) {
                        Toast.fire({
                            icon: "success",
                            title:  response.success
                        });
                    }else{
                        Toast.fire({
                            icon: "error",
                            title:  'Try again something worng !'
                        });
                    }

                    getCart();
                    //getCart();
                } ,
                error : (error)=>{
                    console.log(error)
                }
            })



        }
    </script>
@endpush
