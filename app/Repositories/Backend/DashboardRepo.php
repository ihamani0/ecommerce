<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\DashboardInterface;
use App\Models\Order;
use App\Models\VisitorLog;
use Carbon\Carbon;

class DashboardRepo implements DashboardInterface {
    // Define your class methods here

    private $order;

    public function __construct()
    {
        $this->order = Order::query();
    }

    public function getCountOrders(): int
    {
        return  count($this->order->get());
    }


    public function getAllOrders(): \Illuminate\Database\Eloquent\Collection|array
    {
         return $this->order->get();
    }

    public function totalRevenue(): \Illuminate\Database\Eloquent\Collection|array
    {
        return $this->order->where('created_at' , Carbon::today())->sum('amount');
    }

    public function Visitor()
    {
        return VisitorLog::select(DB::raw('DATE(created_at) as date'), DB::raw('COUNT(DISTINCT ip_address) as count'))
            ->whereDate('created_at', Carbon::today())
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();
    }
}
