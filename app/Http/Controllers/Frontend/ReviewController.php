<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Services\Frontend\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function __construct(public ReviewService $review)
    {}

    public function store(Request $request){

        $request->validate(['rating' => ['required'] , 'comment' => ['required' , 'string' , 'max:255']]
            , ['rating' =>"please make rating for the product first"]);
        //save Rating her
        $this->review->store($request);
        return redirect()->route(Constants::WEB_Products_Details , ['uuid'=>$request->product_uuid , 'slug' => 'default']);

    }

}
