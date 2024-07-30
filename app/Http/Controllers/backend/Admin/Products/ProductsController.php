<?php

namespace App\Http\Controllers\backend\Admin\Products;

use App\Constants\Constants;
use App\Contracts\Backend\ProductInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class ProductsController extends Controller
{
    public function __construct(Public ProductInterface $product)
    {
        $this->middleware('permission:view.product,admin')->only('index');
        $this->middleware('permission:add.product,admin')->only('create');
        $this->middleware('permission:update.product,admin')->only('edit');
        $this->middleware('permission:delete.product,admin')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("backend.admin.pages.Product.index" , ['products'=> $this->product->getAllProducts()]);
    }

    //api for ajax call to get subcategory depend on category relation
    public function getSubCategories($Category_id){
        return response()->json($this->product->getSubCategories($Category_id), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("backend.admin.pages.Product.add" ,[
            "Brands" => $this->product->getAllBrands(),
            "Categories" => $this->product->getAllCategories(),
            "Vendors" => $this->product->getAllVendors()
        ] );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductsRequest $request)
    {
        try {
            DB::beginTransaction();
            $this->product->save($request);
            DB::commit();
            return redirect()->route(Constants::Admin_Products_INDEX)->with(['success'=> "The Products add successfully"]);
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with(['error' => $exception->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view("backend.admin.pages.Product.edit" , [
            "product" => $this->product->getProduct($id),
            "Brands" => $this->product->getAllBrands(),
            "Categories" => $this->product->getAllCategories(),
            "Vendors" => $this->product->getAllVendors()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->product->update($request);
            DB::commit();
            return redirect()->route(Constants::Admin_Products_EDIT ,$request->product_uuid)->with(['success'=> "The Products Update successfully"]);
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with(['error' => $exception->getMessage()]);
        }
    }
    /**
     * Update the specified Image in Product
     */
    public function updateImg(Request $request)
    {

        try {
            DB::beginTransaction();
            $this->product->updateMainImgProduct($request);
            DB::commit();
            return redirect()->route(Constants::Admin_Products_EDIT ,$request->product_uuid)->with(['success'=> "The Products Update successfully"]);
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with(['error' => $exception->getMessage()]);
        }
    }


    /**
     * Update the specified Image in Product
     */
    public function updateMultiImg(Request $request)
    {
        try {
            DB::beginTransaction();
            $this->product->updateMultipleImgProduct($request);
            DB::commit();
            return redirect()->route(Constants::Admin_Products_EDIT ,$request->product_uuid)->with(['success'=> "The Products Images Update successfully"]);
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with(['error' => $exception->getMessage()]);
        }
    }


    /**
     * Update the specified Image in Product
     */
    public function AddMultiImg(Request $request)
    {
        $request->validate([
            'multiple_images' => 'required',
            'multiple_images.*' => 'image|mimes:jpeg,png|max:2048',
        ]);
        try {
            DB::beginTransaction();
            $this->product->saveMultiImageProducts($request , $this->product->getProduct($request->product_uuid));
            DB::commit();
            return redirect()->route(Constants::Admin_Products_EDIT ,$request->product_uuid)->with(['success'=> "The Products Images Update successfully"]);
        }catch (\Exception $exception){
            DB::rollBack();
            return back()->with(['error' => $exception->getMessage()]);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        try {
            DB::beginTransaction();
            $this->product->destroy($uuid);
            DB::commit();
            toastr()->closeButton()->addWarning('The SubCategory deleted successfully');
            return redirect()->route(Constants::Admin_Products_INDEX);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting Products: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     * Multiple Images from Table multiple image
     */
    public function  destroyMultiImage(string $id , string $idProduct){
        try {
            DB::beginTransaction();
            $this->product->destroyMultiImage($id);
            DB::commit();
            toastr()->closeButton()->addWarning('The SubCategory deleted successfully');
            return redirect()->route(Constants::Admin_Products_EDIT , $idProduct);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting Images of Products: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }


    public function statusProduct($uuid){
        try {
            DB::beginTransaction();
            $this->product->changeStatus($uuid);
            DB::commit();
            return redirect()->route(Constants::Admin_Products_INDEX)->with(['success'=> 'The Status Change']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error In status Products: ' . $e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }

}
