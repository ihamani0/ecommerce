<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\DashboardInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\VisitorLog;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepo implements DashboardInterface {
    // Define your class methods here

    private $order;

    public function __construct()
    {
        $this->order = Order::query();
    }

    public function getCountOrders($vendorId = null)
    {
        if ($vendorId){


            //OrderItem::with('order')->where('vendor_id' , $vendorId)->get()->pluck('order')->unique();
            return count(OrderItem::with('order')
                    ->where('vendor_id' , $vendorId)
                        ->get()->pluck('order')->unique());
        }
        return  count($this->order->get());
    }


    public function getAllOrders($vendorId = null): \Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection|array
    {
        if ($vendorId){
            //OrderItem::with('order')->where('vendor_id' , $vendorId)->get()->pluck('order')->unique();
            return OrderItem::with('order')
                    ->where('vendor_id' , $vendorId)
                        ->get()->pluck('order')->unique();
        }

        //dd($this->order->with("user")->with("orderItems")->get());
         return $this->order->with("user")->with("orderItems")->latest()->get();
    }

    public function totalRevenue($vendorId = null)
    {
        if ($vendorId){
            //OrderItem::with('order')->where('vendor_id' , $vendorId)->get()->pluck('order')->unique();
            return OrderItem::with('order')
                ->where('vendor_id' , $vendorId)
                    ->get()->pluck('order')->unique()->where('created_at' , Carbon::today())->sum('amount');
        }
        return Order::where('created_at' , Carbon::today())->sum('amount');
    }

    public function Visitor() : int
    {

        return VisitorLog::whereDate('created_at', Carbon::today())
                    ->distinct()
                        ->pluck('ip_address')->count();
    }

    public function orderDelivered($vendorId = null) : int
    {

        if ($vendorId){

            //OrderItem::with('order')->where('vendor_id' , $vendorId)->get()->pluck('order')->unique();
            return OrderItem::with('order')
                ->where('vendor_id' , $vendorId)
                ->get()->pluck('order')->unique()->where('status' , 'delivered')->count() ;
        }

        return count(Order::where("status" , "delivered")->get());
    }

    public function orderReturn($vendorId = null): int
    {
         if($vendorId){
             $orderReturn =OrderItem::with('order')
                 ->where('vendor_id' , $vendorId)
                 ->get()->pluck('order')->unique()->where('return_status' , 1)->where('status' , 'delivered');
             return $orderReturn->count();
         }
         return count(Order::whereDate('created_at' , Carbon::today())->where("return_status" , 1)->get());
    }
}
