<?php

namespace App\Contracts\Backend;

interface DashboardInterface{
    // Define your interface methods here

    public function getAllOrders($vendorId = null);
    public function getCountOrders($vendorId = null);
    public function totalRevenue($vendorId = null);
    public function Visitor();
    public function orderDelivered($vendorId = null);

    public function orderReturn($vendorId = null);
}
