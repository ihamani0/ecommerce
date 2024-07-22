<?php

namespace App\Http\Controllers\backend\Admin\Products;

use App\Contracts\Backend\ProductInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function __construct(Public ProductInterface $product)
    {}

    public function index(){
        return view('backend.admin.pages.Product.stock-index',['products'=> $this->product->getAllProducts()]);
    }

    public function changeStock(Request $request){
        try {
            $this->product->ChangeStock($request);
            return back()->with(['success' => 'The stock Change with value :'. $request->qty]);
        }catch (Exception $exception){
            return back()->with(['error' => $exception->getMessage()]);
        }
    }
}
