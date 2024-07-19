<?php

namespace App\Http\Controllers\backend\Vendor\Review;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Services\Frontend\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(public ReviewService $review)
    {}

    public function index(){

        return view('backend.vendor.pages.Review.index' ,
            ["Reviews" => $this->review->getAllCommentBelongsToVendor(auth()->user()->id)]);
    }
    public function changeStatus($id){
        try {
            $this->review->ChangeStatus($id);
            toastr()->addSuccess('The Comment Approved');
            return redirect()->route(Constants::Vendor_Review_List);
        }catch (\Exception $exception){
            return toastr()->addError($exception->getMessage());
        }
    }
}
