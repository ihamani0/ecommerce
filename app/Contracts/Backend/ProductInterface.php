<?php

namespace App\Contracts\Backend;

use Illuminate\Http\Request;

interface ProductInterface{

    //get one product
    public function  getProduct($uuid);
    //get multipleImgProduct
    /*public function multipleImgProduct($id);*/
    public function getAllProducts();
    // Define your interface methods here

    public function getAllBrands();
    public function getAllCategories();
    public function getAllSubcategories();
    public function getAllVendors();

    //get sub category belong to category
    public function getSubCategories($Category_id);

    //save product
    public function save($request);
    public function update($request);

    //Update main image of product
    public function updateMainImgProduct($request);

    //Update Multiple images of product
    public function updateMultipleImgProduct($request);

    public function saveMultiImageProducts($request , $product);

    //destroy Products
    public function destroy($uuid);
    // Destroy Multi Image
    public function  destroyMultiImage(string $id);

    //changeStatus($id)
    public function changeStatus($uuid);


    //simple validation for image
    public function validateImgsExtns($request);

    //change stocks
    public function ChangeStock(Request $request);

}
