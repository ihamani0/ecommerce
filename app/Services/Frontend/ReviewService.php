<?php

namespace App\Services\Frontend;

use App\Models\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewService{


    public function store(Request $request){

        try {
            DB::beginTransaction();
                review::create([
                    'user_id' => $request->user_id,
                    'vendor_id' => $request->vendor_id,
                    'product_id' => $request->product_id,
                    'comment' => $request->comment,
                    'rating' => $request->rating,
                ]);
            DB::commit();
        }catch (\Exception $exception){
            DB::rollBack();
            throw  new \Exception($exception->getMessage());
        }


    }


    public function getAllComment(){
        return review::all();
    }

    public function getAllCommentBelongsToVendor($id){
        return review::where('vendor_id' , $id)->get();
    }

    public function ChangeStatus($id){
        $review = review::where('id' ,$id)->first();
        $review->status = !$review->status;
        $review->save();
    }

}
