<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Restaurant\RegisterFetch;

class RestaurantController extends Controller
{
    public function registerFetch(RegisterFetch $RegisterFetch)
    {
        \Log::info('test');
        $obj = new RegisterFetch;
        $res = $obj();
        return response()->json($res);
    }
}
