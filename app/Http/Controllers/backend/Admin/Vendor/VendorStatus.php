<?php

namespace App\Http\Controllers\backend\Admin\Vendor;

use App\Contracts\Backend\VendorInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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


    public function  getDetails($id){

        return response()->json($this->vendor->getVendorDetails($id));
    }



}
