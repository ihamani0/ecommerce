<?php

namespace App\Http\Controllers\backend\Admin\Vendor;

use App\Constants\Constants;
use App\Contracts\Backend\VendorInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class VendorStatus extends Controller
{
    public function __construct(public VendorInterface $vendor)
    {}


    public function index_active()
    {
        return view("backend.admin.pages.VendorStatus.VendorsStatusActive",
                ["vendors" => $this->vendor->getVendorsActive()]
        );
    }

    public function index_in_active()
    {
        return view("backend.admin.pages.VendorStatus.VendorsStatusInactive",
            ["vendors" => $this->vendor->getVendorsInActive()]
        );
    }

    public function active($id){
        try {
            DB::beginTransaction();
            $this->vendor->ActiveVendor($id);
            DB::commit();
            return redirect()->route(Constants::Admin_Vendor_StatusInActive_INDEX)->with(['success' => "Vendor Enable Successfully "]);
        }catch (Exception $exception){
            DB::rollBack();
            return back()->with(["error" => $exception->getMessage()]);
        }

    }

    public function inactive($id){
        try {
            DB::beginTransaction();
            $this->vendor->InActiveVendor($id);
            DB::commit();
            return redirect()->route(Constants::Admin_Vendor_StatusActive_INDEX)->with(['success' => "Vendor Disable Successfully "]);
        }catch (Exception $exception){
            DB::rollBack();
            return back()->with(["error" => $exception->getMessage()]);
        }
    }

    public function  getDetails($id){

        return response()->json($this->vendor->getVendorDetails($id));
    }



}
