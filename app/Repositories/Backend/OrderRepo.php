<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\OrderInterface;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class OrderRepo implements OrderInterface {
    // Define your class methods here


    public function getOrdersWithOutReturn()
    {
         return Order::where('return_status' , 0)
                    ->where('status', '!=' , 'completed')
                        ->orderBy('id','DESC')->get();
    }
    public function getReturnOrders()
    {
        return Order::where('return_status' , 1)->orderBy('id','DESC')->get();
    }

    public function getOrdersBelongsToVendor($vendor_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return OrderItem::whereHas('order', function($query) {
            $query->where('return_status', 0)->where('status', '!=' , 'completed');
        })->with('order')
            ->where('vendor_id',$vendor_id)
                                    ->orderBy('id','DESC')->get();
    }


    public function getReturnOrdersBelongsToVendor($vendor_id): \Illuminate\Database\Eloquent\Collection|array
    {
        return OrderItem::with('order')
                ->where('vendor_id',$vendor_id)
                    ->where("return_status" , true)
                        ->orderBy('id','DESC')->get();
    }



    public function getOrdersPendingBelongsToUser($user_id)
    {
         return Order::where('costumer_id' , $user_id)
                 ->where('return_status' , 0)
                     ->where('status', '!=' , 'complete-return-process')
                        ->orderBy('id','DESC')->get();
    }
    public function getOrdersReturnBelongsToUser($user_id)
    {
        return Order::where('costumer_id' , $user_id)->where('return_status' , 1)->orderBy('id','DESC')->get();
    }


    public function getOrdersDetailsByOrderNumber($order_id)
    {
         return Order::with('user')->where('order_number' , $order_id)->first();
    }

    public function getOrdersItemsByOrderId($order_id): \Illuminate\Database\Eloquent\Collection|array
    {
        $Items = OrderItem::with('product')->where('order_id' , $order_id)->orderBy('id','DESC')->get();

        foreach ($Items as $item){
            $item->img_url = Storage::url($item->product->product_thumbnail);
        }
        return $Items;
    }

    public function changeStatus($orderId , $status)
    {
        try {
            DB::beginTransaction();
            Order::where("order_number" , $orderId)->first()->update([
                'status' => $status
            ]);
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function changeReturnStatusOrder($request)
    {
        try {
            DB::beginTransaction();
            $order = Order::where("order_number" , $request->order_number)->first();
            $order->return_reason = $request->return_reason;
            $order->return_status = !$order->return_status;
            $order->save();
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

    public function changeReturnStatusOrderItems($Products)
    {
        try {
            DB::beginTransaction();
            foreach ($Products as $uuid){
                $item = OrderItem::where('product_uuid' , $uuid)->first();
                $item->return_status = true;
                $item->save();
            }
            DB::commit();
        }catch (Exception $exception){
            DB::rollBack();
            throw new Exception($exception->getMessage());
        }
    }

}
