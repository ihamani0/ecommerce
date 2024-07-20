<?php

namespace App\Contracts\Backend;

interface DashboardInterface{
    // Define your interface methods here

    public function getAllOrders();
    public function getCountOrders();
    public function totalRevenue();
    public function Visitor();
}
