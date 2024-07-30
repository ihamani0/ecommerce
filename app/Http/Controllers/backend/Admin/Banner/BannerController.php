<?php

namespace App\Http\Controllers\backend\Admin\Banner;

use App\Constants\Constants;
use App\Contracts\Backend\CrudInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\BannerRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class BannerController extends Controller
{
    public function __construct(public CrudInterface $banner)
    {
        $this->middleware('permission:view.banner,admin')->only('index');
        $this->middleware('permission:add.banner,admin')->only('create');
        $this->middleware('permission:update.banner,admin')->only('edit');
        $this->middleware('permission:delete.banner,admin')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.Banner.index" ,['Banners' => $this->banner->getAll() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.admin.pages.Banner.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BannerRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->banner->save($request);

            DB::commit();
            toastr()->persistent()->closeButton()->addSuccess('The Banner save Successfully');
            return redirect()->route(Constants::Admin_Banner_INDEX);
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

        return view("backend.admin.pages.Banner.edit"
            ,['banner' => $this->banner->getOnlyOne($id)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BannerRequest $request)
    {

        try {
            DB::beginTransaction();

            $this->banner->update($request);

            DB::commit();


            return redirect()->route(Constants::Admin_Banner_INDEX)->with(['success' => "The Banner Update Successfully"]);
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
            $this->banner->delete($uuid);
            return redirect()->route(Constants::Admin_Banner_INDEX)->with(['success' => 'The Banner deleted successfully']);
        } catch (Exception $e) {
            Log::error('Error deleting Banner: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
