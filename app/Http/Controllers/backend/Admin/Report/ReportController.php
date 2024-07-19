<?php

namespace App\Http\Controllers\backend\Admin\Report;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Services\Backend\ReportService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct(public ReportService $report)
    {}


    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $Years = [];
        for ($i=Constants::CreatedApp ; $i <= date('Y') ; $i++){
            $Years[] = $i;
        }
        return view('backend.admin.pages.Report.index' , ['Years'=>$Years]);
    }



    public function searchByDate(Request $request){

        return response()->json($this->report->dailyReport($request->date));
    }
    public function searchByWeek(Request $request){
        return response()->json($this->report->weeklyReport($request->date));
    }

    public function searchByMonth(Request $request){
        return response()->json($this->report->monthlyReport($request->date));
    }
    public function searchByYear(Request $request){
        return response()->json($this->report->yearlyReport($request->date));
    }

}
