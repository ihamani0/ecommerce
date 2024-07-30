<?php

namespace App\Http\Controllers\backend\Admin\Review;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Services\Frontend\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(public ReviewService $review)
    {
        $this->middleware('permission:view.review,admin')->only('index');
        $this->middleware('permission:change-status.review,admin')->only('changeStatus');
    }

    public function index(){

        return view('backend.admin.pages.Review.index' , ["Reviews" => $this->review->getAllComment()]);
    }
    public function changeStatus($id){
        try {
            $this->review->ChangeStatus($id);
            toastr()->addSuccess('THe Comment Approve');
            return redirect()->route(Constants::Admin_Review_List);
        }catch (\Exception $exception){
            return toastr()->addError($exception->getMessage());
        }
    }
}
