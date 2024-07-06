<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\CrudInterface;
use App\Contracts\Backend\CouponInterface;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CouponRepo implements CouponInterface {
    // Define your class methods here

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Coupon::all();
    }

    public function getOnlyOne($id)
    {
        return Coupon::where("coupon_uuid" , $id)->firstOrFail();
    }

    public function save(Request $request)
    {
        Coupon::create([
            "coupon_name" => Str::upper($request->coupon_name) ,
            "coupon_discount" =>  $request->coupon_discount ,
            "coupon_validate" =>  $request->coupon_validate ,
            "coupon_uuid" =>Str::uuid()
        ]);
    }

    public function update(Request $request)
    {
        $coupon = $this->getOnlyOne($request->coupon_uuid);
        $coupon->coupon_name = $request->coupon_name;
            $coupon->coupon_discount = $request->coupon_discount;
                $coupon->coupon_validate = $request->coupon_validate;
        $coupon->save();
    }

    public function delete(string $uuid)
    {
        $coupon = $this->getOnlyOne($uuid);
        $coupon->delete();
    }


    public function changeStatus($uuid)
    {
         $coupon = $this->getOnlyOne($uuid);
         //dd($coupon);
         ($coupon->status) ? $coupon->status = 0 :  $coupon->status = 1 ;
         $coupon->save();
    }
}
