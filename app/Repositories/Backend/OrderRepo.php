<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\OrderInterface;
use App\Models\Order;
use App\Models\OrderItem;

class OrderRepo implements OrderInterface {
    // Define your class methods here


    public function getOrdersPending()
    {
         return Order::where('status' , 'pending')->orderBy('id','DESC')->get();
    }

    public function getOrdersPendingBelongsToVendor($vendor_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return OrderItem::with('order')
                    ->where('vendor_id',$vendor_id)
                            ->orderBy('id','DESC')->get();
    }
}
