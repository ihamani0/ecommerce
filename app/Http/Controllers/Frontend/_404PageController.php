<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Frontend\LandingPageInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class _404PageController extends Controller
{
    public function handle(){
        return response()->view('frontend.pages._404');
    }
}
