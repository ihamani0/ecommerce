<?php

namespace App\Repositories\Frontend;

use App\Contracts\Frontend\LandingPageInterface;
use App\Models\Banner;
use App\Models\Category;
use App\Models\MultiImageProduct;
use App\Models\Product;
use App\Models\slide;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use JetBrains\PhpStorm\ArrayShape;

class LandingPageRepo implements LandingPageInterface {

    public function getAllCategories()
    {
        return Category::orderBy("category_name" , "ASC")->get();
    }

    public function  getCategory($uuid){
        return Category::where('uuid_category' , $uuid)->first();
    }

    public function  getSubcategory($uuid){
        return Subcategory::where('uuid_subcategory' , $uuid)->first();
    }


    public function getAllSlides(): \Illuminate\Database\Eloquent\Collection
    {
        return slide::all();
    }

    public function getAllBanners(): \Illuminate\Database\Eloquent\Collection
    {
        return Banner::all();
    }

    public function getAllProducts(): \Illuminate\Database\Eloquent\Collection
    {
        return Product::active()->latest()->get();
    }

    public function getProduct($uuid)
    {
        return Product::active()->where("products_uuid" , $uuid)->firstOrFail();
    }

    #[ArrayShape(["product" => "mixed","url_img" => "mixed" ,"urls_img" => "mixed" ,"category_name" => "mixed", "vendor_name" => "mixed", "colors" => "mixed", "tags" => "mixed", "sizes" => "mixed" , "discount_price" => "mixed"])]
    public function getProductWithAjax($uuid): array
    {
        $product = Product::active()->where("products_uuid" , $uuid)->firstOrFail();

        $urls_Images = [];

        foreach ($product->MultiplImg as $img){
            $urls_Images[] = Storage::url($img->product_img_name);
        }

        return [
            "product" =>$product ,
            "url_img" => Storage::url($product->product_thumbnail),
            "urls_img" => $urls_Images ,
            "category_name" => $product->category->category_name,
            "vendor_name" => $product->vendor->username ?? null ,
            "colors" => $product->colors(),
            "tags" =>  $product->product_tags,
            "sizes" => $product->sizes() ,
            "discount_price" => ($product->discount_price) ? ($product->selling_price * $product->discount_price) / 100 : null ,
        ];
    }


    public function getAllVendors(){
        return User::where("role" , "vendor")->active()->paginate(10);
    }
    public function getVendorById($id){
        return User::where("role" , "vendor")->where('id' , $id)->active()->first();
    }


    //query offer
    public function getProductsFeatured(){
        return Product::active()->where("featured" , 1)->get();
    }

    public function getProductsHotDeals(){
        return Product::active()->where("hot_deals" , 1)->get();
    }

    public function getProductsSpecialOffer(){
        return Product::active()->where("special_offer" , 1)->get();
    }
    public function getProductsSpecialDeals(){
        return Product::active()->where("special_deals" , 1)->get();
    }



    //ge three Max categories that have products
    //withCount as attributes  products_count that handle counting products dependent on relationship HasMany
    public function countMaxCategories(){
        $count = Category::withCount('products')->get();
        return $count->sortByDesc('products_count')->take(3);
    }

    public function searchByCategory(Request $request)
    {
       return Product::where('product_name', "LIKE" , "%$request->search%")->where("category_id" , $request->category)->get();
    }

    public function searchByName(Request $request)
    {
        if($request->expectsJson()){
            $Products =  Product::where('product_name', "LIKE" , "%$request->search%")
                            ->select(['product_thumbnail' , 'product_name' , 'selling_price'])->get();
            foreach ($Products as $product){
                $product->product_thumbnail = Storage::url($product->product_thumbnail);
            }
            return $Products;
        }

        return Product::where('product_name', "LIKE" , "%$request->search%")->get();
    }
}
