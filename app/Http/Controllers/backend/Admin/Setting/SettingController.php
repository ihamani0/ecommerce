<?php

namespace App\Http\Controllers\backend\Admin\Setting;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Symfony\Component\HttpFoundation\File\Exception\ExtensionFileException;

class SettingController extends Controller
{
    public function index(){


        return view('backend.admin.pages.Setting.index' , ['Setting' =>Setting::firstOrNew()]);
    }

    public function create(){

        return view('backend.admin.pages.Setting.add' );
    }
    public function edit(){
        return view('backend.admin.pages.Setting.edite' , ['Setting' =>Setting::firstOrNew()] );
    }

    public function store(Request $request){
        $setting = new Setting();
        $this->saveOrUpdate($setting,$request);
        return redirect()->route(Constants::Admin_Setting_Index)->with(['success' => 'The Setting Store Successfully']);
    }


    public function update(Request $request){
        $setting =Setting::firstOrNew() ;
        $this->saveOrUpdate($setting,$request);
        return redirect()->route(Constants::Admin_Setting_Index)->with(['success' => 'The Setting Update Successfully']);
    }


    public function delete(){
        try {
            DB::beginTransaction();
            Setting::first()->delete();
            DB::commit();
            return redirect()->route(Constants::Admin_Setting_Index)->with(['warning' => 'The Setting Was Delete it']);
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function saveOrUpdate($setting,Request $request)
    {
        try {
            DB::beginTransaction();

            if ($request->hasFile('logo_website')) {
                if ($setting->logo) {
                    Storage::delete($setting->logo);
                }
                $image = $request->file("logo_website");
                $new_name = 'WebSiteLogo.' . hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $extension = $image->getClientOriginalExtension();

                $path = 'public/upload/' . $new_name;

                if (strtolower($extension) == 'svg') {
                    // Store the SVG file directly
                    Storage::put($path, file_get_contents($image));
                } else {
                    // Process and store other image files
                    error_reporting(E_ERROR | E_PARSE);
                    Image::read($image)->resize(215, 70)->save(storage_path('app/' . $path));
                    error_reporting(E_ALL);
                }

                $setting->logo = $path;
            }
            $setting->company_name = $request->company_name;
            $setting->support_phone = $request->support_phone;
            $setting->address = $request->address;
            $setting->email = $request->email;
            $setting->facebook = $request->facebook;
            $setting->instagram = $request->instagram;
            $setting->youtube = $request->youtube;
            $setting->twitter = $request->twitter;
            $setting->save();

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }

}
