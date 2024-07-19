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

        return view('backend.admin.pages.Setting.index' , ['Setting' =>Setting::all()->first()]);
    }

    public function create(){

        return view('backend.admin.pages.Setting.add' );
    }
    public function edit(){

        return view('backend.admin.pages.Setting.edite' , ['Setting' =>Setting::all()->first()] );
    }

    public function store(Request $request){
        return $this->extracted($request);
    }


    public function update(Request $request){
        return $this->extracted($request);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function extracted(Request $request)
    {
        try {
            DB::beginTransaction();
            //save in setting Table
            $setting = new Setting();

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
                    if ($setting->logo) {
                        Storage::delete($setting->logo);
                    }

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
            $setting->save();


            //save in social Media Table
            $request->validate([
                'name.*' => ['string', 'max:255'],
                'url.*' => ['url'],
                'logo.*' => ['file', 'mimes:svg']
            ]);


            if (!empty($request->name) && !empty($request->logo) && !empty($request->url)) {

                $Names = $request->name;
                $Urls = $request->input('url');
                $Logos = $request->file('logo');

                foreach ($Names as $index => $name) {
                    $logo = $Logos[$index];
                    $new_name = $name . '.' . $logo->getClientOriginalExtension();

                    $extension = $logo->getClientOriginalExtension();
                    $path = 'public/upload/' . $new_name;
                    if (strtolower($extension) == 'svg') {
                        // Store the SVG file directly
                        Storage::put($path, file_get_contents($logo));
                    } else {
                        throw new ExtensionFileException("The Extension mismatch must be Svg");
                    }

                    SocialMedia::create([
                        "config_id" => $setting->id,
                        "name" => $name,
                        "logo" => $path,
                        "url" => $Urls[$index],
                    ]);
                } //endforeach
            }//end if condition

            return redirect()->route(Constants::Admin_Setting_Index)->with(['success' => 'The Setting Store Successfully']);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception->getMessage());
        }
    }

}
