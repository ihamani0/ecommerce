<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminProfileController extends Controller
{
        public function index(){
            $user = Auth::guard("admin")->user();

            return view("backend.admin.pages.profile",["user" => $user]);
        }

        public function store(Request $request){   }
}
