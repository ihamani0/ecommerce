<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\Constants;
use App\Contracts\Frontend\LandingPageInterface;
use App\Http\Controllers\Controller;
use App\Models\compare;
use Illuminate\Http\Request;

class CompareProductsController extends Controller
{

    public function index(){
         return view('frontend.pages.products.compare-products' , [
             'user' => auth()->user(),
         ]);
    }


    public function store(Request $request){

         if(auth()->check()){

            $userId = auth()->user()->id;
            $productId = $request->id;

            $existsInWishList = compare::where('user_id' , $userId)
                ->where('product_id' , $productId)->exists();

            if($existsInWishList){

                return response()->json(['warning' => 'The product is already in your list ']) ;
            }

            auth()->user()->compare()->attach($productId);

            return response()->json(['success' => 'The product add to your List']) ;

        }else{
            return response()->json(['error' => 'You must be Login !!']) ;
        }
    }

    public function destroy($Product_id){

         compare::where('user_id' , auth()->user()->id)
            ->where('product_id' , $Product_id)->delete();

        toastr()->addSuccess('The Product delete it ');
        return redirect()->route(Constants::USER_COMPARE_LIST);
    }

    //get count of product that belongs to user using  ajax
    public function getCount(){
        return response()->json(['count' => count(auth()->user()->compare)]);
    }


}
