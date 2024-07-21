<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\DashboardInterface;
use App\Models\Order;
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

    public function getCountOrders()
    {
        return  count($this->order->get());
    }


    public function getAllOrders(): \Illuminate\Database\Eloquent\Collection|array
    {
        //dd($this->order->with("user")->with("orderItems")->get());
         return $this->order->with("user")->with("orderItems")->latest()->get();
    }

    public function totalRevenue()
    {
        return Order::where('created_at' , Carbon::today())->sum('amount');
    }

    public function Visitor() : int
    {
        return VisitorLog::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(DISTINCT ip_address) as count'))
            ->whereDate('created_at', Carbon::today())
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()->count();
    }

    public function orderDelivered() : int
    {
        return count(Order::where("status" , "delivered")->get());
    }
}
