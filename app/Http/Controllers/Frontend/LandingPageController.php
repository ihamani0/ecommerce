<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Frontend\LandingPageInterface;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\slide;
use Illuminate\Http\Request;

// use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function __construct(public LandingPageInterface $lPage)
    {}

    public function index(){

        //dd($this->lPage->getAllProducts()->take(20)->first()->products_uuid);
        return view("frontend.components.main" ,
                [
                    'Vendors' => $this->lPage->getAllVendors(),
                    'Categories' => $this->lPage->getAllCategories(),
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

    public function productDetails(Request $request,$uuid,$slug){

        if ($request->expectsJson()) {
            $product = $this->lPage->getProductWithAjax($uuid) ;
            // Return product details as JSON
            return response()->json($product);
        }

        return view("frontend.pages.products.product-details" ,
            [
                'Categories' => $this->lPage->getAllCategories(),
                'Product' => $this->lPage->getProduct($uuid),
            ]);
    }

    public function VendorDetails($id){

        /*$vendor =  $this->lPage->getVendorById($id) ;
        $products = $vendor->products()->paginate(3);
        dd($products->);*/

        return view("frontend.pages.vendor.vendor-details" ,
            [
                'Categories' => $this->lPage->getAllCategories(),
                'vendor' => $this->lPage->getVendorById($id),
            ]);
    }

    public function AllVendors(){

        /*$Vendors  = $this->lPage->getAllVendors() ;
        dd($Vendors);*/
        return view("frontend.pages.vendor.all-vendors" ,
            [
                'Categories' => $this->lPage->getAllCategories(),
                'Vendors' => $this->lPage->getAllVendors(),
            ]);
    }


    public function ProductsByCategory($uuid , $slug){

        return view("frontend.pages.products.products-by-category" ,
        [
            'Categories' => $this->lPage->getAllCategories(),
            'category' => $this->lPage->getCategory($uuid),
            'Products' => $this->lPage->getAllProducts()
        ]);
    }
    public function ProductsBySubcategory($uuid , $slug){
        return view("frontend.pages.products.products-by-subcategory" ,
        [
            'Categories' => $this->lPage->getAllCategories(),
            'subcategory' => $this->lPage->getSubcategory($uuid),
            'Products' => $this->lPage->getAllProducts()
        ]);
    }

}
