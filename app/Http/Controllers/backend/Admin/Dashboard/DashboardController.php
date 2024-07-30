<?php

namespace App\Http\Controllers\backend\Admin\Dashboard;

use App\Contracts\Backend\DashboardInterface;
use App\Http\Controllers\Controller;
use App\Http\Resources\Backend\AdminResource;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct(public DashboardInterface $dashboard)
    {}

    public function index(){
        return view("backend.admin.pages.dashboard" , [
            "AllOrders" => $this->dashboard->getAllOrders(),
            "TotalOrders" => $this->dashboard->getCountOrders(),
            "TotalRevenue" =>number_format($this->dashboard->totalRevenue() , 2),
            "Visit" => $this->dashboard->Visitor(),
            "OrderDelivered" => $this->dashboard->orderDelivered(),
            "OrderReturn" => $this->dashboard->orderReturn(),
        ]);
    }


    public function getAdminNotification($id){

        return new AdminResource(Admin::findOrFail($id));
    }
    public function makeAdminNotificationAsRead(Request $request){

        $status = DB::table('notifications')->where('id' , $request->notifyId)
                    ->update(['read_at' => now()]);

        return response()->json('ok');
    }
}
