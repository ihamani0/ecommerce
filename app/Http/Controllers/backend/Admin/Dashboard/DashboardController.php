<?php

namespace App\Http\Controllers\backend\Admin\Dashboard;

use App\Contracts\Backend\DashboardInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct(public DashboardInterface $dashboard)
    {}

    public function index(){
        return view("backend.admin.pages.dashboard");
    }
}
