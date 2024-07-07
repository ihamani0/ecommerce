<?php

namespace App\Contracts\Backend;

interface OrderInterface{
    // Define your interface methods here

    public function getOrdersPending();

    public function getOrdersPendingBelongsToVendor($vendor_id);
}
