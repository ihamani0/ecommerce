<?php

namespace App\Contracts\Backend;

use Illuminate\Http\Request;

interface CrudInterface{
    // Define your interface methods here

    public function getAll();
    public function getOnlyOne($id);
    public function save(Request $request);
    public function update(Request $request);
    public function delete(string $uuid);
}
