@extends("frontend.layout.master")

@section("main")
{{-- Her We Pass Data in session Mode THe Cart and TotalCart and session of Coupon if exsist--}}
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{route(\App\Constants\Constants::USER_INDEX_CHECKOUT_CART)}}" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                <span></span> Stripe Payment
            </div>
        </div>
    </div>

    <div class="container mb-80 mt-50">
        <div class="row">
            <div class="col-lg-8 mb-40">
                <h3 class="heading-2 mb-10">Payment</h3>
                <div class="d-flex justify-content-between">
                    <h6 class="text-body">There are products in your cart</h6>
                </div>
            </div>
        </div>

        <div class="row">

            {{--Information payment--}}
            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Your Order</h4>
                        <h6 class="text-muted">Subtotal</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>
                    <div class="table-responsive order_table checkout">

                        <table class="table no-border">
                            <tbody>

                            @foreach( session("Cart.cart_content") as $product)

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
                                        <h6 class="text-muted">Coupon Name</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h6 class="text-brand text-end">
                                            {{\Illuminate\Support\Facades\Session::get('TotalCart')}}</h6>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Coupon Name</h6>
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
                                        <h6 class="text-muted">SubTotal</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{\Illuminate\Support\Facades\Session::get('Cart.total_cart')}} Dz</h4>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="cart_total_label">
                                        <h6 class="text-muted">Grand Total</h6>
                                    </td>
                                    <td class="cart_total_amount">
                                        <h4 class="text-brand text-end">
                                            {{\Illuminate\Support\Facades\Session::get('Cart.total_cart')}}Dz</h4>
                                    </td>
                                </tr>
                            @endif
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>


            {{--Form of getway--}}
            <div class="col-lg-6">
                <div class="border p-40 cart-totals ml-30 mb-50">
                    <div class="d-flex align-items-end justify-content-between mb-30">
                        <h4>Payment Method </h4>
                        <h6 class="text-muted">Cash</h6>
                    </div>
                    <div class="divider-2 mb-30"></div>

                    <form action="{{route(\App\Constants\Constants::CASH_PAYMENT_STORE)}}" method="POST">
                        @csrf
                        <input type="hidden" name="full_name"
                               value="{{session('Cart.full_name') }}" >
                        <input type="hidden" name="email"
                               value="{{session('Cart.email')}}">
                        <input type="hidden"  name="country"
                               value="{{session('Cart.country')}}">
                        <input type="hidden" name="phone_number"
                               value="{{session('Cart.phone_number')}}">
                        <input type="hidden" name="city"
                               value="{{session('Cart.city')}}">
                        <input type="hidden"  name="postal_code"
                               value="{{session('Cart.postal_code')}}">
                        <input type="hidden" name="state"
                               value="{{session('Cart.state')}}">
                        <input type="hidden" name="address"
                               value="{{session('Cart.address')}}">
                        <input type="hidden" name="add_information"
                               value="{{session('Cart.add_information')}}">
                        <input type="hidden" name="method_payment"
                               value="{{session('Cart.method_payment')}}">
                        <input type="hidden" name="total_cart"
                               value="{{session('Cart.total_cart') }}" >
                        <!-- Checkout will insert the payment form here -->
                        <button type="submit">Submit the Order</button>
                    </form>

                    </div>
                </div>

            </div>

        </div>


    </div>
@endsection
@push('script')


@endpush
