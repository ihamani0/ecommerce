<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\Constants;
use App\Contracts\Frontend\LandingPageInterface;
use App\Contracts\Frontend\OrderInterface;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Services\Frontend\OrderService;
use Gloudemans\Shoppingcart\Facades\Cart;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\throwException;

class CartShopController extends Controller
{

    public function __construct( public OrderService $order_service )
    {}


    //---------for web page-----------------
    public function index(){
        return view('frontend.pages.products.cart-index');
    }

    public function indexCheckOutCart(){

        if(Cart::count() == 0){
            toastr()->addInfo("AT list one product in cart");
            return redirect()->route(Constants::WELCOME);
        }

        return view('frontend.pages.products.cart-checkout' , [
            "ContentCart" => Cart::content(), //get the carts content
            "count_cart" =>  Cart::count(), // how many items there are in your cart
            "TotalCart" =>  Cart::total(), // calculated total of all items in the cart
        ]);
    }

    public function storeCheckOutCart(Request $request){

        $cart = new Collection([
            "full_name" => $request->full_name,
            "email" => $request->email,
            "country" => $request->country,
            "phone_number" => $request->phone_number,
            "city" => $request->city,
            "postal_code" => $request->postal_code,
            "state" => $request->state,
            "address" => $request->address,
            "add_information" => $request->add_information,
            "method_payment" =>  $request->payment_option,
            "percent_off_discount" => (Session::has('coupon')) ?  Session::get('coupon.coupon_discount') : '',
            "cart_content" =>  Cart::content(),
            "total_cart" =>  (Session::has('coupon')) ?  Session::get('coupon.total_amount') : Cart::total(),
        ]);


        try {
            return match ($request->payment_option) {
                'Stripe' => (new StripePaymentController($this->order_service))->createCheckoutSession($cart),
                'CashOnDelivery' =>  redirect()->route(Constants::CASH_PAYMENT_INDEX)->with([
                    "Cart" => $cart , "TotalCart" => Cart::total()
                ]),
                /*'GetawayCash' => redirect()->route(Constants::USER_LOGOUT),*/
                default => redirect()->route(Constants::WELCOME),
            };
        } catch (\Exception $e) {
             throw new \Exception($e->getMessage());
        }
    }


    //---------for ajax request-----------------
     public function addToCart(Request $request){

        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        //Cart::destroy();

         $product = Product::where("products_uuid" ,$request->id)->first();
            Cart::add([
                'id' => $product->products_uuid ,
                'name' => $product->product_name ,
                'qty' => $request->qty,
                'price' => ($product->discount_price) ? $product->selling_price * ($product->discount_price / 100 ) :  $product->selling_price,
                'options' => [
                    'image' => Storage::url($product->product_thumbnail),
                    'colors' => $request->colors ,
                    'sizes' => $request->sizes,
                    'vendor_id' => $request->vendor_id
                ],
            ]);


         return response()->json(['success' => 'the product add to your cart'] );
     }

    public function getTheCart(){

        return response()->json([
           "content_cart" => Cart::content(), //get the carts content
           "count_cart" =>  Cart::count(), // how many items there are in your cart
            "total_cart" =>  Cart::total(), // calculated total of all items in the cart
        ]);
    }

    public function removeFromCart(Request $request){
         Cart::remove($request->rowId);

        $this->updateCouponDiscountTotalIfExists();
         return response()->json(['success' => 'the product remove from your cart'] );
        //return response()->json(['success' => $request->rowId] );
    }


    public function QtyDecrement(Request $request){
        $item = Cart::get($request->rowId);
        Cart::update($request->rowId, ($item->qty - 1) ); // Will update the quantity
        //update Coupon discount total if exists
        $this->updateCouponDiscountTotalIfExists();
        return response()->json(['Success' => 'Decrement']);
    }

    public function QtyIncrement(Request $request){
        $item = Cart::get($request->rowId);
        Cart::update($request->rowId, ($item->qty + 1) ); // Will update the quantity
        //update Coupon discount total if exists
        $this->updateCouponDiscountTotalIfExists();
        return response()->json(['Success' => 'Increment']);
    }


    /*Apply coupon*/
    public function applyCoupon(Request $request){

        $coupon  = Coupon::where('coupon_name' , $request->coupon_name)
                        ->where("coupon_validate" , ">=" , Carbon::now()->format("Y-m-d"))->first();


        if($coupon){
            $discount_amount = Cart::total() * ($coupon->coupon_discount / 100);
            $total_amount =  Cart::total() - $discount_amount;

            Session::put('coupon', [
                'coupon_name' => $coupon->coupon_name ,
                'coupon_discount'=> $coupon->coupon_discount,
                'discount_amount' => $discount_amount ,
                'total_amount' => round($total_amount)
            ]);

            return response()->json(['success' => "The coupon applied" , 'validate' => true]);
        }
        return response()->json(['error' => "The coupon invalid"]);
    }


    public function getCoupon(){
        if(Session::has('coupon')){
            return response()->json([
                'applied' => true ,
                'coupon' => [
                        'total' => Cart::total(),
                        'coupon_name' => Session::get('coupon.coupon_name'),
                        'coupon_discount' => Session::get('coupon.coupon_discount'),
                        'discount_amount' => Session::get('coupon.discount_amount'),
                        'total_amount' => Session::get('coupon.total_amount'),
                ]
            ]);
        }

        return response()->json([
            'applied' => false ,
            'coupon' => ['total' => Cart::total()]
        ]);
    }

    public function removeCoupon(){
        Session::forget('coupon');
        return response()->json(['success' => 'the coupon is remove it']);
    }

    /**
     * @return void
     */
    public function updateCouponDiscountTotalIfExists(): void
    {
        if (Session::has('coupon')) {
            // Retrieve current session data
            $coupon_name = Session::get('coupon.coupon_name');

            $CouponFormDb = Coupon::where('coupon_name' , $coupon_name)->first();

            $discount_amount = Cart::total() * ($CouponFormDb->coupon_discount / 100);
            $total_amount =  Cart::total() - $discount_amount;
            // Put the updated data back into the session
            Session::put('coupon', [
                'coupon_name' => $CouponFormDb->coupon_name ,
                'coupon_discount'=> $CouponFormDb->coupon_discount,
                'discount_amount' => $discount_amount ,
                'total_amount' => $total_amount
            ]);
        }
    }

    public function clearCart(){
        if(Cart::count() == 0){
            return response()->json(['error' => 'The Cart is Empty !!']);
        }

        Cart::destroy();
        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        return response()->json(['success' => 'Clear The Cart']);
    }
}
