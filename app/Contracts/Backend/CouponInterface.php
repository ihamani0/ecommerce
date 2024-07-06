<?php

namespace App\Contracts\Backend;

use App\Contracts\Backend\CrudInterface;

interface CouponInterface extends CrudInterface{
    // Define your interface methods here
    public function changeStatus($uuid);
}
