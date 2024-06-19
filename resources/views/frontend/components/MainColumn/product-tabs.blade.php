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
                                        {{--<img class="hover-img" src="{{ \Illuminate\Support\Facades\Storage::url($item->product_thumbnail) }}" alt="" />--}}
                                    </a>
                                </div>
                                <div class="product-action-1">
                                    <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                    <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>

                                    {{--Quick view button--}}
                                    <a aria-label="Quick view" class="action-btn" id="{{$item->products_uuid}}" onclick="fetchProduct(this.id)"
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
                                        <div class="product-rating" style="width: 90%"></div>
                                    </div>
                                    {{--Start Rate--}}
                                    <span class="font-small ml-5 text-muted"> (4.0)</span>
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
                                            <a aria-label="Add To Wishlist" class="action-btn" href="shop-wishlist.html"><i class="fi-rs-heart"></i></a>
                                            <a aria-label="Compare" class="action-btn" href="shop-compare.html"><i class="fi-rs-shuffle"></i></a>

                                            {{--Quick view Button--}}
                                            <a aria-label="Quick view" id="{{$product->products_uuid}}" onclick="fetchProduct(this.id)"
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

@push('script')
    <script>
        function fetchProduct(id,slug='default'){
            let baseUrl = '{{url('/Product-details/')}}' ;
            let fullUrl = `${baseUrl}/${id}/${slug}`
             $.ajax({
                 type:'GET',
                 dataType:'json' ,
                 url :fullUrl ,
                 success : (response)=>{
                    //console.log(response)
                     setData(response)
                 } ,
                 error : (error)=>{
                     console.error(error);
                 }
             })
        }
        function setData(data){
            let $img_url = {{\Illuminate\Support\Facades\Storage::url("+data.product.image_url+")}}
            $('#slide_img').attr('src', data.url_img )
            $('#thumbnail_img').attr('src', data.url_img )

            $('#product_name').text(data.product.product_name)


            let urlProductDetails = `/Product-details/${data.product.products_uuid}/default`
            $('#product_name').attr('href',urlProductDetails )


            if(data.product.product_Qty > 0){
                $('#product_sale').addClass('stock-status in-stock');
                $('#product_sale').text('in stock')
            }else{
                $('#product_sale').addClass('stock-status out-stock');
                $('#product_sale').text('out stock');
            }

            if (data.discount_price) {
                $("#product_price").text(data.discount_price)
                $("#save_price").text("save "+ (100 - data.product.discount_price)+ "%")
                $("#old_price").text(data.product.selling_price)
            } else {
                $("#product_price").text(data.product.selling_price)
            }

            if(data.vendor_name){
                //vendor_name
                $("#vendor_name").text(data.vendor_name)
            }else{
                $("#vendor_name").text("E comme")
            }

            $("#category_name").text(data.category_name)


            // Color
            if(!data.colors){ //if array is empty hide the choice of color
                $("#Parent_div_display_color").hide();
            }else{  // else is not empty

                $("#Parent_div_display_color").show(); // show the dce of parent content
                $("#child_div_display_color").empty(); // Clear any existing content

                data.colors.forEach( (item, index) => {
                    let colorId = "size_"+index
                    let colorLabel = $("<label></label>").addClass('form-check-label fw-500').attr('for', colorId).text(item);
                    let colorinput = $("<input/>").attr({
                            type: 'checkbox',
                            class: 'form-check-input',
                            name: 'select_colors[]',
                            id: colorId,
                            value: item
                        });

                    let labelParent = $("<label></label>").addClass("form-check form-check-inline")
                    labelParent.append(colorLabel)
                    labelParent.append(colorinput)
                    // Append the new elements to the div
                    $("#child_div_display_color").append(labelParent);

                })
            }
                // end Color
            if(!data.sizes){
                $("#Parent_div_display_size").hide();
            }else{
                $("#Parent_div_display_size").show();
                $("#child_div_display_sizes").empty(); // Clear any existing content
                data.sizes.forEach( (item, index) => {

                    let sizeId = "size_"+index
                    let sizeLabel = $("<label></label>").addClass('form-check-label fw-500').attr('for', sizeId).text(item);
                    let sizeInput = $("<input/>").attr({
                        type: 'checkbox',
                        class: 'form-check-input',
                        name: 'select_size[]',
                        id: sizeId,
                        value: item
                    });
                    let labelParnet = $("<label></label>").addClass("form-check form-check-inline")
                    labelParnet.append(sizeLabel)
                    labelParnet.append(sizeInput)
                    // Append the new elements to the div
                    $("#child_div_display_sizes").append(labelParnet);
                })
            }

            //
            if(data.tags){
               $("#tags").text(data.tags)
            }



        }
    </script>
@endpush

