<?php

namespace App\Http\Controllers\backend\Admin\Category;

use App\Constants\Constants;
use App\Contracts\Backend\CrudInterface;
use App\Contracts\Backend\SubcategoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\SubcategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class SubcategoryController extends Controller
{
    public function __construct(public CrudInterface $sub_category)
    {
        $this->middleware('permission:view.subcategory,admin')->only('index');
        $this->middleware('permission:add.subcategory,admin')->only('create');
        $this->middleware('permission:update.subcategory,admin')->only('edit');
        $this->middleware('permission:delete.subcategory,admin')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view("backend.admin.pages.Subcategories.index" ,['subcategorys' => $this->sub_category->getAll() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories=[];
        if ($this->sub_category instanceof SubcategoryInterface){
            $categories = $this->sub_category->getCategorys();
        }
        return view("backend.admin.pages.Subcategories.add" ,['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SubcategoryRequest $request)
    {

        try {
            DB::beginTransaction();

            $this->sub_category->save($request);

            DB::commit();
            toastr()->persistent()->closeButton()->addSuccess('The SubCategory save Successfully');
            return redirect()->route(Constants::Admin_SubCategory_INDEX);
        }catch (Exception $e){
            DB::rollBack();
            return back(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        $categories=[];
        if ($this->sub_category instanceof SubcategoryInterface){
            $categories = $this->sub_category->getCategorys();
        }

        return view("backend.admin.pages.Subcategories.edit",
            [
                'category' => $this->sub_category->getOnlyOne($uuid) ,
                'categories' => $categories
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SubcategoryRequest $request)
    {

        try {
            DB::beginTransaction();

            $this->sub_category->update($request);

            DB::commit();

            toastr()->addSuccess('The SubCategory Update Successfully');
            return redirect()->route(Constants::Admin_SubCategory_INDEX);
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
            $this->sub_category->delete($uuid);
            toastr()->closeButton()->addWarning('The SubCategory deleted successfully');
            return redirect()->route(Constants::Admin_SubCategory_INDEX);
        } catch (Exception $e) {
            Log::error('Error deleting brand: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
