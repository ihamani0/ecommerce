<?php

namespace App\Services\Backend;

use App\Contracts\Backend\ProfileRepoInterface;
use App\Contracts\Backend\ProfileServiceInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminProfileService implements ProfileServiceInterface{
    // Define your service methods here

    public function __construct(public ProfileRepoInterface $adminRep)
    {
    }

    public function attempt(array $cred): bool
    {
       return Auth::guard("admin")->attempt( $cred );
    }

    public function checkPassword($OldPasswordFromInput): bool
    {
        $userPasswordFromDataBase = $this->adminRep->getUser()->password;

        return Hash::check( $OldPasswordFromInput , $userPasswordFromDataBase);
    }
}
