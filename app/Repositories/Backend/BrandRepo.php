<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\CrudInterface;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class BrandRepo implements CrudInterface {

    // Define your class methods here
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Brand::all();
    }

    public function getOnlyOne($id){
        return Brand::where("uuid_brand" , $id)->firstOrFail();
    }

    public function save(Request $request)
    {
        $brand = new Brand();
        $brand->uuid_brand = Str::uuid();
        $this->saveOrUpdate($brand, $request);
    }

    public function update(Request $request)
    {
        $brand = $this->getOnlyOne($request->uuid_brand);
        $this->saveOrUpdate($brand, $request);
    }

    public function saveOrUpdate($brand, $request)
    {

        $brand->brand_name=$request->brand_name;
        $brand->brand_slug=Str::slug($request->brand_name);

        if ($request->hasFile('brand_image')) {
            if($brand->brand_img){
                Storage::delete($brand->brand_img);
            }
            $image = $request->file("brand_image");
            $new_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $path = 'public/upload/brands/' . $new_name;

            Image::read($image)->resize(300,300)->save(storage_path('app/'.$path));
            $brand->brand_img =  $path;
        }

        $brand->save();
    }


    public function delete(string $uuid)
    {
        $brand = $this->getOnlyOne($uuid);
        if ($brand->brand_img) {
            Storage::delete($brand->brand_img);
        }
        $brand->delete();
    }

}
