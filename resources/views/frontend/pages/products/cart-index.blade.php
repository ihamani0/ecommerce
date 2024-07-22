@extends("frontend.layout.master")

@section("main")
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route(App\Constants\Constants::WELCOME)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Shop
                <span></span> Cart
            </div>
        </div>
    </div>
    <div class="container mb-80 mt-50">

        <div class="row">
            <div class="col-lg-8 mb-40 ">
                <h1 class="heading-2 mb-10">Your Cart</h1>
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between  align-items-center">

                    <h6 class="text-body mb-2 mb-sm-0">There are
                        <span class="text-brand" id="productsInCart"></span>
                        products in your cart</h6>
                    <h6 class="text-body mt-3 mt-sm-0"><a class="text-muted" onclick="ClearCart()"><i class="fi-rs-trash mr-5"></i>Clear Cart</a></h6>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive shopping-summery">
                    <table class="table table-wishlist">
                        <thead>
                        <tr class="main-heading">
                            <th class="custome-checkbox start pl-30">#</th>
                            <th scope="col" colspan="2">Product</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">size</th>
                            <th scope="col">color</th>
                            <th scope="col">SubTotal</th>
                            <th scope="col" class="end">Remove</th>
                        </tr>
                        </thead>
                        <tbody id="bodyCart">

                        {{--Contnet of cart is her --}}

                        </tbody>
                    </table>
                </div>


                <div class="row mt-50">

                    @if(! \Illuminate\Support\Facades\Session::has('coupon'))
                        <div class="col-sm-4 col-lg-5" id="CouponField">
                            <div class="p-40">
                                <h4 class="mb-10">Apply Coupon</h4>
                                <p class="mb-30"><span class="font-lg text-muted">Using A Promo Code?</span></p>


                                <div class="d-flex justify-content-between ">
                                    <input class="font-medium mr-15 coupon" id="coupon_name" placeholder="Enter Your Coupon">
                                    <button class="btn" type="button" onclick="applyCoupon()" >
                                        <i class="fi-rs-label mr-10"></i>Apply</button>
                                </div>


                            </div>
                        </div>
                    @endif



                    <div class="col-lg-7">
                        <div class="divider-2 mb-30"></div>



                        <div class="border p-md-4 cart-totals ml-30">
                            <div class="table-responsive">
                                <table class="table no-border">
                                    <tbody id="body_Coupon">
                                            {{--From ajax--}}
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{route(\App\Constants\Constants::USER_INDEX_CHECKOUT_CART)}}" class="btn mb-20 w-100">Proceed To CheckOut<i class="fi-rs-sign-out ml-15"></i></a>
                        </div>
                    </div>



                </div>
            </div>

        </div>
    </div>
@endsection

@push('script')

    <script>
        function applyCoupon(){
            let couponName = $("#coupon_name").val();

            if(!couponName){
                Toast.fire({
                    icon: "error",
                    title:  'Please insert the coupon!'
                });
            return ;
            }

           let baseURL = "{{route('api.apply.coupon')}}"
            $.ajax({
                  type : "POST" ,
                  dataType : 'json' ,
                  url :  baseURL ,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data : {coupon_name : couponName } ,
                success : (response) =>{
                      if(response.validate){
                          $("#CouponField").hide();
                      }
                    if ($.isEmptyObject(response.error)) {
                        Toast.fire({
                            icon: "success",
                            title:  response.success
                        });
                        getCoupon();
                    }else{
                        Toast.fire({
                            icon: "error",
                            title:  response.error
                        });
                    }
                } ,
                error : error => {
                    console.log(error)
                }
            });

        }

        function getCoupon(){
            let baseURL = "{{route('api.get.coupon.apply')}}"
            $.ajax({
                type : "GET" ,
                dataType : 'json' ,
                url :  baseURL ,

                success : (response) =>{
                    let row ='';
                    if(response.applied){
                        row = ` <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${response.coupon.total} Dz</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                </tr>
                                <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">${response.coupon.coupon_name}</h5>
                                        </td>
                                        <td><a onclick="couponRemove()" ><i class="fa-solid fa-trash" /></a></td>

                                </tr>
                                <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Discount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h5 class="text-heading text-end">${response.coupon.coupon_discount} %</h5>
                                        </td>

                                </tr>
                                <tr>
                                    <td scope="col" colspan="2">
                                        <div class="divider-2 mt-10 mb-10"></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Discount Amount</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${response.coupon.discount_amount} Dz</h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${response.coupon.total_amount} Dz</h4>
                                    </td>
                                </tr>`
                    }else{
                        row = `<tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">${response.coupon.total} Dz</h4>
                                    </td>
                               </tr>`
                    }
                    $("#body_Coupon").html(row);

                } ,
                error : error => {
                    console.log(error)
                }
            });
        }

        getCoupon();


        function couponRemove(){
            let baseUrl = '{{route('api.remove.coupon.apply')}}';
            $.ajax({
                type : "GET" ,
                dataType : 'json' ,
                url :  baseUrl ,
                success : (response) =>{
                    Toast.fire({
                        icon: "success",
                        title:  response.success
                    });
                    $("#CouponField").show();
                    getCoupon();
                } ,
                error : error => {
                    console.log(error)
                }
            });
        }
    </script>



    <script>

            function cart(){
                let baseUrl = '{{route('api.get.cart.index')}}' ;
                $.ajax({
                    type : "GET" ,
                    url : baseUrl ,
                    dataType:'json' ,

                    success : (response)=>{
                        $("#productsInCart").text(response.count_cart);

                        let row ='';
                        $.each(response.content_cart , (index , value) => {
                            row += setDataInRow(index,value);
                        });
                        $('#bodyCart').html(row);
                    } ,
                    error : (error)=>{

                    }
                });//end ajax
            }

            //start the function when load page
            cart();


        function setDataInRow(index,value){
            return `
            <tr class="pt-30">
                <td class="custome-checkbox pl-30"></td>

                /*Image of product*/
                <td class="image product-thumbnail pt-40"><img src="${value.options.image}" alt="#"></td>

                /*Name of product*/
                <td class="product-des product-name">
                <h6 class="mb-5"><a class="product-name mb-10 text-heading"
                 href='/Product-details/${value.id}/${value.name}'
                 >
                ${value.name}
                </a></h6>
                </td>

                /*Price*/
                <td class="price" data-title="Price">
                    <h4 class="text-body">${value.price} Dz</h4>
                </td>

            {{--Quantity--}}

                <td class="text-center detail-info" data-title="Stock">
                    <div class="detail-extralink mr-15">
                        <div class="detail-qty border radius">
                            <a type='submit' class="qty-down" data-id=${value.rowId} onclick='qty_down(this)'  ><i class="fi-rs-angle-small-down"></i></a>
                            <input type="text" name="quantity" class="qty-val" value="${value.qty}" min="1">
                            <a type='submit' class="qty-up" data-id=${value.rowId} onclick='qty_up(this)'><i class="fi-rs-angle-small-up"></i></a>
                        </div>
                    </div>
                </td>

            <td class="price" data-title="Size">
                <h4 class="product-des product-name">${value.options.sizes==null? "/": value.options.sizes}</h4>
            </td>

            <td class="price" data-title="Color">
                <h4 class="product-des product-name">${value.options.colors==null? "/": value.options.colors}</h4>
            </td>

            <td class="price" data-title="Price">
                <h4 class="text-brand">${value.subtotal} Dz</h4>
            </td>



            <td class="action text-center" data-title="Remove"><a class="text-body" data-id=${value.rowId}
            onclick="removeProduct(this)"
            ><i class="fi-rs-trash"></i></a></td>

        </tr>`
        }

        function removeProduct(element){
            let rowId = element.getAttribute("data-id");
            $.ajax({
                type:'POST' ,
                dataType: 'json',
                //contentType: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url :'{{route(\App\Constants\Constants::REMOVE_FROM_CART)}}',
                data : {
                    'rowId' : rowId
                },
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

                    getCoupon();
                    //this function for header
                    getCart();
                    //this function for the page
                    cart();
                },
                error : (error)=>{
                    console.log(error)
                }
            }); //end ajax

        } //end remove product remove cart

            function qty_down(element){
                let rowId = element.getAttribute("data-id");
                $.ajax({
                    type:'POST' ,
                    dataType: 'json',
                    //contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url :'{{route('api.qty.decrement')}}',
                    data : {
                        'rowId' : rowId
                    },
                    success : (response)=>{

                        //calculate
                        getCoupon();
                        //this function for header
                        getCart();
                        //this function for the page
                        cart();
                    },
                    error : (error)=>{
                        alert(error)
                    }
                }); //end ajax
            }//end qty_down  cart

            function qty_up(element){
                let rowId = element.getAttribute("data-id");
                $.ajax({
                    type:'POST' ,
                    dataType: 'json',
                    //contentType: 'application/json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url :'{{route('api.qty.increment')}}',
                    data : {
                        'rowId' : rowId
                    },
                    success : (response)=>{
                        //calculate
                        getCoupon();
                        //this function for header
                        getCart();
                        //this function for the page
                        cart();
                    },
                    error : (error)=>{
                        alert(error)
                    }
                }); //end ajax
            }//end qty_up  cart


    </script>


    <script>
        function ClearCart(){
            $.ajax({
                type:'GET' ,
                dataType: 'json',
                url :'{{route('api.clear.cart')}}',

                success : (response)=>{

                    if ($.isEmptyObject(response.error)) {
                        Toast.fire({
                            icon: "success",
                            title:  response.success
                        });
                    }else{
                        Toast.fire({
                            icon: "error",
                            title:  response.error
                        });
                    }
                    $("#CouponField").show();

                    getCoupon();
                    //this function for header
                    getCart();
                    //this function for the page
                    cart();
                },
                error : (error)=>{
                    console.log(error)
                }
            }); //end ajax
        }
    </script>
@endpush
