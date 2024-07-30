<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\Constants;
use App\Contracts\Frontend\LandingPageInterface;

use App\Http\Controllers\Controller;
use App\Services\Frontend\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CashOnDeliveryController extends Controller
{

    public function __construct(protected  OrderService $order_service)
    {}
    //

    public function index(){

        return view('frontend.pages.payment.cash-payment');
    }



    public function store(Request $request){
        //Collection::make
        $order = collect($request->all()) ;

        //session
        $sessionData = (object)[
            'payment_method_types' => ['card'],
            'currency' => 'dzd',
            'amount_total' => $order->get('total_cart') ,
            'metadata' => (object)['order_id' => uniqid('Od')],
        ];

        try {
            DB::beginTransaction();
            //store the data in database
            $this->order_service->storeOrder($order , $sessionData);

            DB::commit();
            return redirect()->route(Constants::USER_ACCOUNT_DASHBOARD)
                        ->with(['success'=>"Your order was placed Successfully !"]);
        }catch (\Exception $exception){
            DB::rollBack();
            // Log the exception message
            Log::error('Order placement failed: ' . $exception->getMessage());
            throw new \Exception($exception->getMessage());
            //return redirect()->route(Constants::WELCOME)->with('error', "An error occurred. Please try again!");
        }

    }

}
