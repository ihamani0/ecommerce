<?php

namespace App\Repositories\Frontend;

use App\Contracts\Frontend\OrderInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;
use Stripe\Checkout\Session;

class OrderRepo implements OrderInterface {
    // Define your class methods here

    public function storeOrder($cart,$session): int
    {
        try {
            //insert order
            $orderId = DB::table('orders')->insertGetId([
                //cart
                "costumer_id"=>auth()->user()->id,
                "country"=>$cart->get("country"),
                "city"=>$cart->get("city"),
                "state"=>$cart->get("state"),
                "name"=>$cart->get("full_name"),
                "email"=>$cart->get("email"),
                "phone_number"=>$cart->get("phone_number"),
                "code_post"=>$cart->get("postal_code"),
                "address"=>$cart->get("address"),
                "note"=>$cart->get("add_information"),

                "payment_method"=>$cart->get("method_payment"),

                "payment_type"=>$session->payment_method_types[0], //card

                /*"transaction_id"=>"",*/
                "currency"=>$session->currency,
                "amount"=>$session->amount_total,
                "order_number"=>$session->metadata->order_id,

                "invoice_number"=>'EOS'.mt_rand(10000000,99999999),
                /*"confirmed_date"=>"",
                "processing_date"=>"",
                "picked_date"=>"",
                "shipped_date"=>"",
                "delivered_date"=>"",
                "cancel_date"=>"",
                "return_date"=>"",
                "return_reason"=>"",*/
                "status"=>"pending",
                'created_at' => Carbon::now()

            ]);
            //insert orderItem
            foreach (\Gloudemans\Shoppingcart\Facades\Cart::content() as $item){
                OrderItem::create([
                    "order_id"=>$orderId,
                    "product_uuid"=>$item->id,
                    "vendor_id"=>$item->options->vendor_id,
                    "price"=>$item->price,
                    "color"=>$item->options->colors,
                    "size"=>$item->options->sizes,
                    "qty"=>$item->qty,
                ]);
            }

            $this->destroyCart();

            return $orderId;
        }catch (\Exception $exception){
            Log::error('Order placement failed: ' . $exception->getMessage());
            Log::error('Stack trace: ' . $exception->getTraceAsString());
            // Rethrow the exception with the original message for further handling if needed
            throw new \Exception("An error occurred while placing the order (OrderRepo): " . $exception->getMessage());
        }
    }

    public function getOrderById($orderId){
        // Retrieve the order by ID
        return Order::where( 'id' , $orderId)->first();
    }



    private function destroyCart(){
        if(\Illuminate\Support\Facades\Session::has('coupon')){
            \Illuminate\Support\Facades\Session::forget('coupon');
        }
        \Gloudemans\Shoppingcart\Facades\Cart::destroy();
    }


}
