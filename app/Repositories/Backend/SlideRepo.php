<?php

namespace App\Repositories\Backend;

use App\Contracts\Backend\CrudInterface;
use App\Models\slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;

class SlideRepo implements CrudInterface{
    // Define your class methods here
    public function getAll()
    {
        return slide::latest()->get();
    }

    public function getOnlyOne($id)
    {
        return slide::where("slide_uuid" , $id)->first();
    }

    public function save(Request $request)
    {
        $slide = new slide();
        $slide->slide_uuid = Str::uuid();
        $this->saveOrUpdate($slide , $request);
    }

    public function update(Request $request)
    {

         $slide = $this->getOnlyOne($request->slide_uuid);
         $this->saveOrUpdate($slide , $request);
    }

    public function delete(string $uuid)
    {
         $slide = $this->getOnlyOne($uuid);
         if($slide->slide_image){
             Storage::delete($slide->slide_image);
         }
         $slide->delete();
    }

    public function saveOrUpdate($slide, $request)
    {

        $slide->slide_title=$request->slide_title;
        $slide->slide_text=$request->slide_text;

        if ($request->hasFile('slide_image')) {
            if($slide->slide_image){
                Storage::delete($slide->slide_image);
            }
            $image = $request->file("slide_image");

            $new_name = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();

            $directory = 'public/upload/slides';

            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory, 0755, true);
            }

            $path = $directory . '/' . $new_name;

            error_reporting(E_ERROR | E_PARSE);
            Image::read($image)->resize(2376,807)->save(storage_path('app/'.$path));
            error_reporting(E_ALL);

            $slide->slide_image =  $path;
        }

        $slide->save();
    }


}
