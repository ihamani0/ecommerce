<?php

namespace App\Contracts\Backend;

use App\Contracts\Backend\CrudInterface;

interface SubcategoryInterface extends CrudInterface {
    // Define your interface methods here

    public function getCategorys();
}
