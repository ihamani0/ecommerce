<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\CrudInterface;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class BannerRepo implements CrudInterface {
    // Define your class methods here
    public function getAll()
    {
         return Banner::latest()->get();
    }

    public function getOnlyOne($id)
    {
        return Banner::where("banner_uuid", $id)->first();
    }

    public function save(Request $request)
    {
        $banner = new Banner();
        $banner->banner_uuid = Str::uuid();
        $this->saveOrUpdate($banner , $request);
    }

    public function update(Request $request)
    {
        $banner = $this->getOnlyOne($request->banner_uuid);
        $this->saveOrUpdate($banner , $request);
    }

    public function delete(string $uuid)
    {
        $banner = $this->getOnlyOne($uuid);
        if($banner->banner_image){
            Storage::delete($banner->banner_image);
        }
        $banner->delete();
    }

    public function saveOrUpdate($banner, $request)
    {

        $banner->banner_title=$request->banner_title;
        $banner->banner_url=$request->banner_url;

        if ($request->hasFile('banner_image')) {
            if($banner->banner_image){
                Storage::delete($banner->banner_image);
            }
            $image = $request->file("banner_image");

            $new_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $directory = 'public/upload/banners';

            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory, 0755, true);
            }

            $path = $directory . '/' . $new_name;

            error_reporting(E_ERROR | E_PARSE);
            Image::read($image)->resize(768,450)->save(storage_path('app/'.$path));
            error_reporting(E_ALL);

            $banner->banner_image =  $path;
        }

        $banner->save();
    }
}
