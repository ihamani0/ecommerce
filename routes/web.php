<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





Route::middleware('auth')->group(function (){



    // Route::middleware('role:vendor')->group(function (){
    //     Route::namespace('Vendor')->group(function () {
    //         Route::get("vendor/dasboard" , [App\Http\Controllers\Vendor\VendorController::class,'index'])->name('vendor.dashboard');
    //     });
    // //end middlware role vendor
    // });



 //end middlware auth
});




