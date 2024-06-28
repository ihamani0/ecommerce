<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartShopController extends Controller
{
     public function addToCart(Request $request){

        //Cart::destroy();

         $product = Product::where("products_uuid" ,$request->id)->first();



            Cart::add([
                'id' => $product->products_uuid ,
                'name' => $product->product_name ,
                'qty' => $request->qty,
                'price' => ($product->discount_price) ? $product->selling_price * ($product->discount_price / 100 ) :  $product->selling_price,
                'options' => [
                    'image' => Storage::url($product->product_thumbnail),
                    'colors' => $request->colors ,
                    'sizes' => $request->sizes,
                ],
            ]);


         return response()->json(['success' => 'the product add to your cart'] );
     }

    public function getTheCart(){
        return response()->json([
           "content_cart" => Cart::content(), //get the carts content
           "count_cart" =>  Cart::count(), // how many items there are in your cart
            "total_cart" =>  Cart::total(), // calculated total of all items in the cart
        ]);
    }

    public function removeFromCart(Request $request){
         Cart::remove($request->rowId);
         return response()->json(['success' => 'the product remove from your cart'] );
        //return response()->json(['success' => $request->rowId] );
    }


}
