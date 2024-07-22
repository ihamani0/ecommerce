<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\ProductInterface;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImageProduct;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use PHPUnit\Runner\FileDoesNotExistException;

class ProductRepo implements ProductInterface {

    public function  getProduct($uuid){
        return Product::where("products_uuid" , $uuid )->first();
    }


    public function getAllProducts(){
        if(auth()->guard('admin')->check()){
            return Product::latest()->get();
        }
        return Product::where("vendor_id" , auth()->user()->id)->latest()->get();
    }


    public function getAllBrands()
    {
        return Brand::latest()->get();
    }

    public function getAllCategories()
    {
        return Category::latest()->get();
    }

    public function getAllSubcategories()
    {
        return Subcategory::latest()->get();
    }

    public function getAllVendors()
    {
        return User::where("role" , "vendor")
                    ->where("status" , 1)
                        ->get();
    }

    public function getSubCategories($Category_id)
    {
        return  Subcategory::where("category_id" , $Category_id )->latest()->get();
    }

    public function save($request)
    {
        $product = new Product();
        $product->products_uuid = Str::uuid();
        $product ?? throw new Exception("The Record is not exists");
        $this->saveOrUpdate($product,$request);
        $this->saveMultiImageProducts($request , $product);
    }

    /**
     * @throws Exception
     */
    public function update($request)
    {
        $product = Product::where("products_uuid" , $request->product_uuid)->first();
            $product ?? throw new Exception("The Record is not exists");
        $this->saveOrUpdate($product,$request);
    }

    public function saveOrUpdate($product,$request){

        $product->product_name=$request->product_name;
        $product->product_slug=Str::slug($request->product_name);
        $product->product_code =$request->product_code;
        $product->product_Qty =$request->product_Qty;
        $product->product_size=$request->product_size;
        $product->product_color=$request->product_color;
        $product->product_tags=$request->product_tags;

        $product->selling_price=$request->selling_price;
        if($request->discount_price){
            //different = price - discount  // offer = (different/price) * 100 // round() -> tadwire lil wi7da
            $different = $product->selling_price - $request->discount_price;
            $offer = ($different/$product->selling_price) * 100 ;
            $product->discount_price = round($offer);
        }else{
            $product->discount_price=$request->discount_price;
        }


        $product->short_description=$request->short_description;
        $product->long_description =$request->long_description;

        $product->hot_deals=$request->hot_deals;
        $product->featured=$request->featured;
        $product->special_offer=$request->special_offer;
        $product->special_deals=$request->special_deals;

        $product->status = 1;

        $product->brands_id =$request->brand_id;
        $product->category_id =$request->category_id;
        $product->subcategory_id =$request->subcategory_id;
        $product->vendor_id =$request->vendor_id;

        if ($request->hasFile('product_thumbnail')) {
            $image = $request->file("product_thumbnail");
            $path = $this->getStr($image, $request);

            $product->product_thumbnail =  $path;
        }


        $product->save();

    }



    public function updateMainImgProduct($request){
        $product = $this->getProduct($request->product_uuid);
        if ($request->hasFile('product_thumbnail')) {

            if($product->product_thumbnail){
                Storage::delete($product->product_thumbnail);
            }

            $image = $request->file("product_thumbnail");
            $path = $this->getStr($image, $request);

            $product->product_thumbnail =  $path;

            $product->save();
        }
    }



    public function updateMultipleImgProduct($request){

        $product = $this->getProduct($request->product_uuid);

        if($request->hasFile('multiple_images')){
            $images = $request->file('multiple_images');

            foreach ($images as $id => $img ){

                $old_image = MultiImageProduct::where("id" , $id)->first();

                if($old_image->product_img_name){
                    Storage::delete($old_image->product_img_name);
                }

                $path = $this->getStr($img, $request);

                $old_image->update([
                    'product_id' => $product->id,
                    'product_img_name' => $path
                ]);
            }//enf foreach
        }

    }




    public function saveMultiImageProducts($request , $product){
        if($request->hasFile('multiple_images')){
            $images = $request->file('multiple_images');
            foreach ($images as $img ){
                $path = $this->getStr($img, $request);

                MultiImageProduct::create([
                    'product_id' => $product->id,
                    'product_img_name' => $path
                ]);
            }//enf foreach
        }//end if
    }


    public function  destroyMultiImage(string $id){

        $image = MultiImageProduct::where("id" , $id)->first();
        if ($image->product_img_name) {
            Storage::delete($image->product_img_name);
        }
        $image->delete();
    }

    /**
     * @param string $uuid
     * For SDelete the Products
     * @throws Exception
     */
    public function destroy($uuid){

        $product = $this->getProduct($uuid);

        $images = MultiImageProduct::where("product_id" , $product->id)->get();

        if($images->isNotEmpty()){
            foreach ($images as $img){
                // Delete the image file from storage
                Storage::delete($img->product_img_name);
                // Delete the image record from the database
                $img->delete();
            }
        }

        if($product->product_thumbnail){
            Storage::delete($product->product_thumbnail);
        }

        $product->delete();
    }

    /**
     * @param string $uuid
     * For change status of product if is available or not
     * @throws Exception
     */
    public function changeStatus($uuid){
        $product = $this->getProduct($uuid);
        ($product) ?? throw new Exception("The record is not available");
        //if status is true make it false // if false make it true
        ($product->status) ? $product->status=0 : $product->status=1;
        $product->save();
    }



    /**
     * @param mixed $img
     * @param $request
     * @return string
     */
    public function getStr(mixed $img, $request): string
    {
        $new_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

        $category = Category::where("id", $request->category_id)->first();

        $directory = 'public/upload/products/' . $category->category_name;

        if (!Storage::exists($directory)) {
            Storage::makeDirectory($directory, 0755, true);
        }

        $path = $directory . '/' . $new_name;


        error_reporting(E_ERROR | E_PARSE);
        Image::read($img)->resize(800, 800)->save(storage_path('app/' . $path));
        error_reporting(E_ALL);
        return $path;
    }

    public function validateImgsExtns($request)
    {

        $request->validate(
            [
                'multiple_images' => 'required',
                'multiple_images.*' => 'image|mimes:jpeg,png|max:2048',
            ],
            [
                'multiple_images.*' => "The Image Is allowed is Jpeg/jpg/png"
            ]
        );
    }

    public function ChangeStock($request)
    {

        try {
            DB::BeginTransaction();

            Product::where('products_uuid' , $request->product_uuid)->update([
                "product_Qty" => $request->qty
            ]);

            DB::commit();
        }catch (Exception $exception){
            throw new Exception($exception->getMessage());
        }

    }
}
