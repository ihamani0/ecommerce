<?php

namespace App\Http\Controllers\backend\Vendor;

use App\Contracts\Backend\DashboardInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VendorController extends Controller
{

    public function __construct(public DashboardInterface $dashboard)
    {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id =auth()->user()->id;
        return view("backend.vendor.pages.dashboard" , [
            "AllOrders" => $this->dashboard->getAllOrders($id),
            "TotalOrders" => $this->dashboard->getCountOrders($id),
            "TotalRevenue" =>number_format($this->dashboard->totalRevenue($id) , 2),
            "OrderReturn" => $this->dashboard->orderReturn($id),
            "OrderDelivered" => $this->dashboard->orderDelivered($id),
            ] );
    }


}
