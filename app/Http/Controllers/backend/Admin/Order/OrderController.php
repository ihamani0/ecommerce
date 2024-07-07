<?php

namespace App\Http\Controllers\backend\Admin\Order;

use App\Contracts\Backend\OrderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderInterface $order)
    {}

    public function index(){

         return view('backend.admin.pages.Order.index' , [
             "Orders" => $this->order->getOrdersPending()
         ]);
     }

}
