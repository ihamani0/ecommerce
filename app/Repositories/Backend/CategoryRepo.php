<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\CrudInterface;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

//use Intervention\Image\ImageManagerStatic as Image;  --> composer require intervention/image

class CategoryRepo implements CrudInterface {
    // Define your class methods here
    public function getAll()
    {
        return Category::all();
    }

    public function getOnlyOne($id)
    {
        return Category::where("uuid_category" , $id)->firstOrFail();
    }

    public function save(Request $request)
    {
        $category = new Category();
        $category->uuid_category = Str::uuid();
        $this->saveOrUpdate($category, $request);
    }

    public function update(Request $request)
    {
        $category = $this->getOnlyOne($request->uuid_category);
        $this->saveOrUpdate($category, $request);
    }



    public function delete(string $uuid)
    {
        $category = $this->getOnlyOne($uuid);
        if ($category->category_img) {
            Storage::delete($category->category_img);
        }
        $category->delete();
    }




    public function saveOrUpdate($category, $request)
    {

        $category->category_name=$request->category_name;
        $category->category_slug=Str::slug($request->category_name);

        if ($request->hasFile('category_image')) {
            if($category->category_img){
                Storage::delete($category->category_img);
            }
            $image = $request->file("category_image");
            $new_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            $extension = $image->getClientOriginalExtension();

            $path = 'public/upload/categorys/' . $new_name;


            if (strtolower($extension) == 'svg') {
                // Store the SVG file directly
                Storage::put($path, file_get_contents($image));
            } else {
                // Process and store other image files
                error_reporting(E_ERROR | E_PARSE);
                Image::make($image)->resize(120, 120)->save(storage_path('app/' . $path));
                error_reporting(E_ALL);
            }

            $category->category_img =  $path;
        }

        $category->save();
    }

}
