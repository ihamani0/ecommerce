<?php

namespace App\Contracts\Backend;

interface VendorInterface{

    public function getVendorsInActive();
    public function getVendorsActive();
    public function getVendorDetails($id);
}
