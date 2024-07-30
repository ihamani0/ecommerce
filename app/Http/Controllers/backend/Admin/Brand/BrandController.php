<?php

namespace App\Http\Controllers\backend\Admin\Brand;

use App\Constants\Constants;
use App\Contracts\Backend\CrudInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Laravel\Facades\Image;
use Mockery\Exception;


class BrandController extends Controller
{
    public function __construct(public CrudInterface $brand)
    {
        $this->middleware('permission:view.brand,admin')->only('index');
        $this->middleware('permission:add.brand,admin')->only('create');
        $this->middleware('permission:update.brand,admin')->only('edit');
        $this->middleware('permission:delete.brand,admin')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.Brand.index" , ["brands" => $this->brand->getAll()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.admin.pages.Brand.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->brand->save($request);

            DB::commit();
            toastr()->persistent()->closeButton()->addSuccess('The Brand save Successfully');
            return redirect()->route(Constants::Admin_BRAND_INDEX);
        }catch (Exception $e){
            DB::rollBack();
            return back(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("backend.admin.pages.Brand.edit"
            ,['brand' => $this->brand->getOnlyOne($id)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request)
    {

        try {
            DB::beginTransaction();

            $this->brand->update($request);

            DB::commit();

            toastr()->persistent()->closeButton()->addSuccess('The Brand Update Successfully');
            return redirect()->route(Constants::Admin_BRAND_INDEX);
        }catch (Exception $e){
            DB::rollBack();
            return back(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            $this->brand->delete($uuid);
            toastr()->closeButton()->addWarning('The Brand deleted successfully');
            return redirect()->route('admin.brand.index');
        } catch (Exception $e) {
            Log::error('Error deleting brand: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
