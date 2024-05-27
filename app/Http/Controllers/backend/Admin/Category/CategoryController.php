<?php

namespace App\Http\Controllers\backend\Admin\Category;

use App\Constants\Constants;
use App\Contracts\Backend\CrudInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class CategoryController extends Controller
{

    public function __construct(public CrudInterface $category)
    {}



    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.Category.index" ,['categorys' => $this->category->getAll() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.admin.pages.Category.add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        try {
            DB::beginTransaction();

            $this->category->save($request);

            DB::commit();
            toastr()->persistent()->closeButton()->addSuccess('The Category save Successfully');
            return redirect()->route(Constants::Admin_Category_INDEX);
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
        return view("backend.admin.pages.Category.edit"
        ,['category' => $this->category->getOnlyOne($id)]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request)
    {

        try {
            DB::beginTransaction();

            $this->category->update($request);

            DB::commit();

            toastr()->addSuccess('The Category Update Successfully');
            return redirect()->route(Constants::Admin_Category_INDEX);
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
            $this->category->delete($uuid);
            toastr()->closeButton()->addWarning('The Category deleted successfully');
            return redirect()->route(Constants::Admin_Category_INDEX);
        } catch (Exception $e) {
            Log::error('Error deleting brand: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
