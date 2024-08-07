<?php

namespace App\Contracts\Frontend;

use Illuminate\Http\Request;

interface LandingPageInterface{



    public function getAllCategories();
    public function  getCategory($uuid);

    public function  getSubcategory($uuid);

    public function getAllSlides();

    public function getAllBanners();

    public function getAllProducts();

    public function getProduct($uuid);
    public function getProductwithAjax($uuid);

    public function getProductsFeatured();
    public function getProductsHotDeals();
    public function getProductsSpecialOffer();
    public function getProductsSpecialDeals();

    public function countMaxCategories();

    public function getAllVendors();
    public function getVendorById($id);


    //search
    public function searchByCategory(Request $request);
    public function searchByName(Request $request);
}
