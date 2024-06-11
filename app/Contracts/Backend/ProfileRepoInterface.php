<?php

namespace App\Contracts\Backend;

use Illuminate\Http\Request;

interface ProfileRepoInterface {
    // Define your interface methods here

    public function UpdateProfile(Request $request);

    public function getUser();

    public function UpdatePassword(Request $request);

}
