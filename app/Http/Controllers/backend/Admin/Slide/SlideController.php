<?php

namespace App\Http\Controllers\backend\Admin\Slide;

use App\Constants\Constants;
use App\Contracts\Backend\CrudInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\SlideRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class SlideController extends Controller
{
    public function __construct(public CrudInterface $slide)
    {
        $this->middleware('permission:view.slider,admin')->only('index');
        $this->middleware('permission:add.slider,admin')->only('create');
        $this->middleware('permission:update.slider,admin')->only('edit');
        $this->middleware('permission:delete.slider,admin')->only('destroy');
    }



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.slide.index" ,['Slides' => $this->slide->getAll() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.admin.pages.slide.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SlideRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->slide->save($request);

            DB::commit();
            toastr()->persistent()->closeButton()->addSuccess('The Slide save Successfully');
            return redirect()->route(Constants::Admin_Slide_INDEX);
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

        return view("backend.admin.pages.Slide.edit"
            ,['slide' => $this->slide->getOnlyOne($id)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SlideRequest $request)
    {

        try {
            DB::beginTransaction();

            $this->slide->update($request);

            DB::commit();


            return redirect()->route(Constants::Admin_Slide_INDEX)->with(['success' => "The Slide Update Successfully"]);
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
            $this->slide->delete($uuid);
            return redirect()->route(Constants::Admin_Slide_INDEX)->with(['success' => 'The Slide deleted successfully']);
        } catch (Exception $e) {
            Log::error('Error deleting slide: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
