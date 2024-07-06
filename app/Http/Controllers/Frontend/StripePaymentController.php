<?php

namespace App\Http\Controllers\Frontend;




use App\Http\Controllers\Controller;
use App\Services\Frontend\OrderService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;

class StripePaymentController extends Controller
{

    public StripeClient $stripe;

    public function __construct(protected OrderService $order_service)
    {

        $this->stripe = new StripeClient(
            config('stripe.api_key.secret_key')
        );

    }


    public function createCheckoutSession(Collection $cart){

        Stripe::setApiKey(config('stripe.api_key.secret_key'));

        $lineItems = $this->getLineItems($cart->get('cart_content'));

        $coupon = null;

        // return the id of creating coupon if the session has coupon applied
        if(Session::has('coupon')){
            $coupon = $this->createCoupon($cart->get('percent_off_discount'));
        }

        $session = $this->createStripeSession($lineItems, $coupon);

        //database
        try {

            //Insert the record Order in DataBase
            $this->order_service->storeOrder($cart,$session);

        }catch (\Exception $e){
            DB::rollBack();
            Log::error('Error Store Order with stripe method :' . $e->getMessage());
            throw new \Exception($e->getMessage());
        }


        return redirect($session->url);
    }


    private function getLineItems($CartContent){
        /*
         * This get the content of product and make them as this to send them to Strip
         * so foreach item in the cart Content and set the name and price and quantity
         * */
        $lineItems = [];
            foreach ($CartContent as $prodcut){
                $lineItems[] =[
                    'price_data' => [
                        'currency' => 'DZD',
                        'product_data' => [
                            'name' => $prodcut->name,
                        ],
                        'unit_amount' => $prodcut->price * 100, // Convert to cents
                    ],
                    'quantity' => $prodcut->qty,
                ];
            }
        return $lineItems;
    }

    private function  createCoupon($percent_off_discount){
        return $this->stripe->coupons->create([
            'duration' => 'once',
            'percent_off' => $percent_off_discount,
        ])->id;
    }

    private function createStripeSession($lineItems , $coupon = null){

        $sessionData = [
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => url('/payment/success'),
            'cancel_url' => url('/payment/failed'),
            'metadata' => ['order_id' => uniqid('Od')],
        ];

        if($coupon){
            $sessionData['discounts'] = [[
                'coupon' => $coupon ,
            ]];
        }

        try {
            return $this->stripe->checkout->sessions->create($sessionData);
        } catch (ApiErrorException $e) {
            Log::error('Error In Api :' . $e->getMessage());
        }
    }


}
