<?php

namespace App\Contracts\Backend;

interface OrderInterface{
    // Define your interface methods here

    public function getOrdersWithOutReturn();
    public function getReturnOrders();

    public function getOrdersBelongsToVendor($vendor_id);
    public function getReturnOrdersBelongsToVendor($vendor_id);

    public function getOrdersPendingBelongsToUser($user_id);
    public function getOrdersReturnBelongsToUser($user_id);

    public function getOrdersDetailsByOrderNumber($order_id);
    public function getOrdersItemsByOrderId($order_id);

    public function changeStatus($orderId,$status);

    public function changeReturnStatusOrder($request);
    public function changeReturnStatusOrderItems($Products);
}
