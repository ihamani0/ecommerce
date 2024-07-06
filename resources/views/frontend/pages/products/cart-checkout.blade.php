@extends("frontend.layout.master")

@section("main")
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route(\App\Constants\Constants::USER_INDEX_CHECKOUT_CART)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Checkout
            </div>
        </div>
    </div>

    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Checkout</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are products in your cart</h6>
                </div>
            </div>
        </div>

        <form method="post" action="{{route(\App\Constants\Constants::USER_STORE_CHECKOUT_CART)}}">
            @csrf
            <div class="row">

                <div class="col-lg-7">

                    <div class="row">
                        <h4 class="mb-30">Billing Details</h4>

                            <div class="row">
                                <div class="form-group col-lg-6">
                                    <input type="text" required="" name="full_name" placeholder="User Name *" value="{{auth()->user()->username}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input type="email" required="" name="email" placeholder="Email *" value="{{auth()->user()->email}}">
                                </div>
                            </div>

                            <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" name="country">
                                            <option value="">Select an option...</option>
                                            <option value="DZ" selected>Algeria</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input required="" type="text" name="phone_number" placeholder="Phone*"
                                           value="{{auth()->user()->phone_number}}">
                                </div>
                            </div>

                            <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <div class="custom_select">
                                        <select class="form-control select-active" name="city">
                                            <option value="">Select an option...</option>
                                            <option value="setif" selected>Setif</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-lg-6">
                                    <input required="" type="text" name="postal_code" placeholder="Post Code *"
                                           value="{{auth()->user()->postal_code}}">
                                </div>
                            </div>


                            <div class="row shipping_calculator">
                                <div class="form-group col-lg-6">
                                    <input required="" type="text" name="state" placeholder="City 600 *"
                                           value="{{auth()->user()->state}}">
                                </div>
                                <div class="form-group col-lg-6">
                                    <input required="" type="text" name="address" placeholder="Address *"
                                           value="{{auth()->user()->street_address}}">
                                </div>
                            </div>





                            <div class="form-group mb-30">
                                <textarea rows="5" placeholder="Additional information" name="add_information"></textarea>
                            </div>
                    </div>
                </div>


                <div class="col-lg-5">
                    <div class="border p-40 cart-totals ml-30 mb-50">
                        <div class="d-flex align-items-end justify-content-between mb-30">
                            <h4>Your Order</h4>
                            <h6 class="text-muted">Subtotal</h6>
                        </div>
                        <div class="divider-2 mb-30"></div>
                        <div class="table-responsive order_table checkout">
                            <table class="table no-border">
                                <tbody>

                                @foreach($ContentCart as $product)

                                <tr>
                                    <td class="image product-thumbnail">
                                        <img src="{{url($product->options->image)}}" alt="#">
                                    </td>
                                    <td>
                                        <h6 class="w-160 mb-5"><a href="shop-product-full.html" class="text-heading">
                                                {{$product->name}}</a>
                                        </h6></span>

                                        <div class="product-rate-cover">

                                            @if($product->options->colors)
                                                <strong>Color : {{$product->options->colors}}</strong>
                                            @endif
                                            @if($product->options->sizes)
                                                <strong>Size : {{$product->options->sizes}} </strong>
                                            @endif


                                        </div>
                                    </td>
                                    <td>
                                        <h6 class="text-muted pl-20 pr-20">x {{$product->qty}}</h6>
                                    </td>
                                    <td>
                                        <h4 class="text-brand">{{$product->price}} Dz</h4>
                                    </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>




                            <table class="table no-border">
                                <tbody>
                                @if(\Illuminate\Support\Facades\Session::has('coupon'))
                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Subtotal</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                {{$TotalCart}} Dz
                                            </h4>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupn Name</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h6 class="text-brand text-end">
                                                {{\Illuminate\Support\Facades\Session::get('coupon.coupon_name')}}</h6>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Coupon Discount</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                {{\Illuminate\Support\Facades\Session::get('coupon.discount_amount')}} Dz</h4>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="cart_total_label">
                                            <h6 class="text-muted">Grand Total</h6>
                                        </td>
                                        <td class="cart_total_amount">
                                            <h4 class="text-brand text-end">
                                                {{\Illuminate\Support\Facades\Session::get('coupon.total_amount')}} Dz</h4>
                                        </td>
                                    </tr>

                                @else

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Subtotal</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{$TotalCart}} Dz</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{$TotalCart}} Dz</h4>
                                    </td>
                                </tr>
                                @endif
                                </tbody>
                            </table>





                        </div>
                    </div>
                    <div class="payment ml-30">
                        <h4 class="mb-30">Payment</h4>
                        <div class="payment_option">
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" value="Stripe" id="exampleRadios3" checked="">
                                <label class="form-check-label" for="exampleRadios3" data-bs-toggle="collapse" data-target="#bankTranfer" aria-controls="bankTranfer">
                                    Stripe Payment</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" value="CashOnDelivery" id="exampleRadios4" checked="">
                                <label class="form-check-label" for="exampleRadios4" data-bs-toggle="collapse" data-target="#checkPayment" aria-controls="checkPayment">
                                    Cash on delivery</label>
                            </div>
                            <div class="custome-radio">
                                <input class="form-check-input" required="" type="radio" name="payment_option" value="OnlineGetaway" id="exampleRadios5" checked="">
                                <label class="form-check-label" for="exampleRadios5" data-bs-toggle="collapse" data-target="#paypal" aria-controls="paypal">
                                    Online Getaway</label>
                            </div>
                        </div>
                        <div class="payment-logo d-flex">
                            <img class="mr-15" src="{{asset('frontend/assets/imgs/theme/icons/payment-paypal.svg')}}" alt="">
                            <img class="mr-15" src="{{asset('frontend/assets/imgs/theme/icons/payment-visa.svg')}}" alt="">
                            <img class="mr-15" src="{{asset('frontend/assets/imgs/theme/icons/payment-master.svg')}}" alt="">
                            {{--<img src="{{asset('frontend/assets/imgs/theme/icons/payment-master.svg')}}" alt="">--}}
                        </div>
                        <button type="submit" class="btn btn-fill-out btn-block mt-30">Place an Order<i class="fi-rs-sign-out ml-15"></i></button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection
