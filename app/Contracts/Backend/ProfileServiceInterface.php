<?php

namespace App\Contracts\Backend;

interface ProfileServiceInterface {

    public function attempt(Array $cred);

    public function checkPassword($OldPasswordFromInput);

}
