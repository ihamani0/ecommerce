<?php

namespace App\Http\Controllers\backend\Admin\Coupon;

use App\Constants\Constants;

use App\Contracts\Backend\CouponInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class CouponsController extends Controller
{

    public function __construct(public CouponInterface $coupon)
    {}

    public function index()
    {
        return view("backend.admin.pages.Coupons.index" ,['coupons' => $this->coupon->getAll() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.admin.pages.Coupons.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $this->coupon->save($request);

            DB::commit();
            toastr()->persistent()->closeButton()->addSuccess('The Coupon save Successfully');
            return redirect()->route(Constants::Admin_Coupon_INDEX);
        }catch (Exception $e){
            DB::rollBack();
            return back(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("backend.admin.pages.Coupons.edit"
            ,['Coupon' => $this->coupon->getOnlyOne($id)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {

        try {
            DB::beginTransaction();

            $this->coupon->update($request);

            DB::commit();

            toastr()->addSuccess('The Coupon Update Successfully');
            return redirect()->route(Constants::Admin_Coupon_INDEX);
        }catch (Exception $e){
            DB::rollBack();
            return back(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $this->coupon->delete($uuid);
            toastr()->closeButton()->addWarning('The Coupon deleted successfully');
            return redirect()->route(Constants::Admin_Coupon_INDEX);
        } catch (Exception $e) {
            Log::error('Error deleting Coupon: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }


    public function status(string $uuid)
    {
        try {

            $this->coupon->changeStatus($uuid);
            toastr()->closeButton()->addSuccess('The Status Change successfully');
            return redirect()->route(Constants::Admin_Coupon_INDEX);
        } catch (Exception $e) {
            Log::error('Error Status Change: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
