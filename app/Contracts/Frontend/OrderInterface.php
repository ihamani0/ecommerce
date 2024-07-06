<?php

namespace App\Contracts\Frontend;

use Stripe\Checkout\Session;
use \Illuminate\Support\Collection;

interface OrderInterface{
    // Define your interface methods here

    public function storeOrder(Collection $cart,Session $session);
    public function getOrderById($orderId);

}
