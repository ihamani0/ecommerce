<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\Constants;
use App\Contracts\Frontend\LandingPageInterface;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

// use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function __construct(public LandingPageInterface $lPage)
    {}

    public function index(){

        return view("frontend.components.main" ,
                [
                    'Vendors' => $this->lPage->getAllVendors(),
                    'Slides' => $this->lPage->getAllSlides(),
                    'Banners' => $this->lPage->getAllBanners(),
                    'Products' => $this->lPage->getAllProducts(),
                    'Featured' => $this->lPage->getProductsFeatured(),
                    'HotDeals' => $this->lPage->getProductsHotDeals(),
                    'SpecialOffer'=> $this->lPage->getProductsSpecialOffer() ,
                    'SpecialDeals'=> $this->lPage->getProductsSpecialDeals() ,
                    'MaxCategories'=> $this->lPage->countMaxCategories() ,
                ]);
    }


    /*----------------Search-------------------*/
    public function search(Request $request){

        if($request->expectsJson()){
            return response()->json($this->lPage->searchByName($request));
        }

        $request->validate(['search' => 'required']);

        if($request->category){
            //search by category
            Session::put('products' , $this->lPage->searchByCategory($request));
            Session::put('category' , Category::where('id' , $request->category)->first());
            //redirect
            return redirect()->route(Constants::WEB_SEARCH_BY_Category);
        }
            //search by name
            Session::put('products' , $this->lPage->searchByName($request));
            return redirect()->route(Constants::WEB_SEARCH_Name_Product);
    }



    public function searchByCategory(){
        //dd( Session::get('category') , Session::get('products'));

        return view('frontend.pages.Search.search-by-category' , [
                "category" => Session::get('category'),
                "products" => Session::get('products'),
            ]);

    }
    public function searchNameProduct(){
        return view('frontend.pages.Search.search', [
            "products" => Session::get('products'),
        ]);
    }
    /*--------------------------------------------*/


    public function productDetails(Request $request,$uuid,$slug){

        if ($request->expectsJson()) {
            $product = $this->lPage->getProductWithAjax($uuid) ;
            // Return product details as JSON
            return response()->json($product);
        }

        return view("frontend.pages.products.product-details" ,
            [
                'Product' => $this->lPage->getProduct($uuid),
            ]);
    }

    public function VendorDetails($id){
        return view("frontend.pages.vendor.vendor-details" ,
            [
                'vendor' => $this->lPage->getVendorById($id),
            ]);
    }

    public function AllVendors(){

        /*$Vendors  = $this->lPage->getAllVendors() ;
        dd($Vendors);*/
        return view("frontend.pages.vendor.all-vendors" ,
            [
                /*'Categories' => $this->lPage->getAllCategories(),*/
                'Vendors' => $this->lPage->getAllVendors(),
            ]);
    }


    public function ProductsByCategory($uuid , $slug){

        return view("frontend.pages.products.products-by-category" ,
        [
            /*'Categories' => $this->lPage->getAllCategories(),*/
            'category' => $this->lPage->getCategory($uuid),
            'Products' => $this->lPage->getAllProducts()
        ]);
    }
    public function ProductsBySubcategory($uuid , $slug){
        return view("frontend.pages.products.products-by-subcategory" ,
        [
            /*'Categories' => $this->lPage->getAllCategories(),*/
            'subcategory' => $this->lPage->getSubcategory($uuid),
            'Products' => $this->lPage->getAllProducts()
        ]);
    }

}
