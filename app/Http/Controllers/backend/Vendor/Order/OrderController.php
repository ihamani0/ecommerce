<?php

namespace App\Http\Controllers\backend\Vendor\Order;

use App\Constants\Constants;
use App\Contracts\Backend\OrderInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct(public OrderInterface $order)
    {}

    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.vendor.pages.Order.index' , [
            "OrderItems" => $this->order->getOrdersBelongsToVendor( auth()->user()->id )
        ]);
    }

    public function viewDetails($orderId): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $Order = $this->order->getOrdersDetailsByOrderNumber($orderId) ;
        return view('backend.vendor.pages.Order.view' , [
            "order" => $Order,
            "date" => $Order->created_at->format('l, d-m-Y'),
            "orderItems" => $this->order->getOrdersItemsByOrderId($Order->id)
        ]);
    }

    public function return(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {

        return view('backend.vendor.pages.Order.return' , [
            "OrderItems" => $this->order->getReturnOrdersBelongsToVendor( auth()->user()->id  )
        ]);
    }
    public function changeStatus($orderNumber,$status): \Illuminate\Http\RedirectResponse
    {
        try {
            $this->order->changeStatus($orderNumber,$status);
            return redirect()->route(Constants::Vendor_ORDER_VIEW , $orderNumber )->with(['success' => "The Status Has been Changed Successfully"]);
        }catch (\Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

}
