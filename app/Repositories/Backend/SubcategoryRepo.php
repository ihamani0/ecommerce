<?php

namespace App\Repositories\Backend;


use App\Contracts\Backend\SubcategoryInterface;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SubcategoryRepo implements SubcategoryInterface {
    // Define your class methods here
    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return Subcategory::all();
    }

    public function getOnlyOne($uuid)
    {
        return Subcategory::where("uuid_subcategory" , $uuid)->firstOrFail();
    }

    public function save(Request $request)
    {
        Subcategory::create([
           "subcategory_name" => $request->subcategory_name ,
            "subcategory_slug" =>Str::slug($request->subcategory_name)  ,
            "category_id" =>  $request->category_id ,
            "uuid_subcategory" =>Str::uuid()
        ]);
    }

    public function update(Request $request)
    {

        $category = $this->getOnlyOne($request->uuid_subcategory);
        $category->subcategory_name=$request->subcategory_name;
        $category->subcategory_slug= Str::slug($request->subcategory_name);
        $category->category_id=$request->category_id;
        $category->save();
    }

    public function delete(string $uuid)
    {
        $category = $this->getOnlyOne($uuid);
        $category->delete();
    }

    public function getCategorys(): \Illuminate\Database\Eloquent\Collection
    {
         return Category::orderBy('category_name','ASC')->get();
    }
}
