<?php

namespace App\Http\Controllers\backend\Admin\Order;

use App\Constants\Constants;
use App\Contracts\Backend\OrderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderInterface $order)
    {}

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {

         return view('backend.admin.pages.Order.index-pending' , [
             "Orders" => $this->order->getOrdersWithOutReturn()
         ]);
     }

    public function return_index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application
    {

        return view('backend.admin.pages.Order.index-return' , [
            "Orders" => $this->order->getReturnOrders()
        ]);
    }


    public function view($orderId): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        $Order = $this->order->getOrdersDetailsByOrderNumber($orderId) ;

        return view('backend.admin.pages.Order.view-pending' , [
            "order" => $Order,
            "date" => $Order->created_at->format('l, d-m-Y'),
             "orderItems" => $this->order->getOrdersItemsByOrderId($Order->id)
        ]);
    }

    public function changeStatus($orderNumber ,$status): \Illuminate\Http\RedirectResponse
    {

        try {
            $this->order->changeStatus($orderNumber,$status);
            return redirect()->route(Constants::Admin_Order_VIEW , $orderNumber )->with(['success' => "The Status Has been Changed Successfully"]);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }

    }


}
