<?php


namespace App\Http\View\Composers;

use App\Models\Category;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view): void
    {
        $Categories = Category::orderBy("category_name" , "ASC")->get();
        $Setting = \App\Models\Setting::first();
        $view->with('Setting', $Setting)->with('Categories',$Categories);
    }
}
