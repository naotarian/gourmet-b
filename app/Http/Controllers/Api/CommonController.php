<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    //
    public function saveFileDrive() {
        $save_dir = config('app.save_dir');
        if($save_dir) return $save_dir;
        return storage_path() . '/app/images/';
    }
}
