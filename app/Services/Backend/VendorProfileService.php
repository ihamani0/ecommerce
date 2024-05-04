<?php

namespace App\Services\Backend;

use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class VendorProfileService implements ProfileServiceInterface{
    // Define your service methods here

    public function __construct(public ProfileRepoInterface $vendorProfile)
    {
    }

    public function attempt(Array $cred): bool
    {
        return Auth::attempt($cred);
    }

    public function checkPassword($OldPasswordFromInput): bool
    {
        //get user password from the repos of vendor
        $userPasswordFromDataBase = $this->vendorProfile->getUser()->password;

        return Hash::check( $OldPasswordFromInput , $userPasswordFromDataBase);
    }

}
