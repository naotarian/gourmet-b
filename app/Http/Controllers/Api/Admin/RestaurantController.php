<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Restaurant\RegisterFetch;
use App\UseCases\Restaurant\RegisterPost;
use App\UseCases\Restaurant\InitializeFetch;

class RestaurantController extends Controller
{
    public function registerFetch(Request $req)
    {
        $obj = new RegisterFetch;
        $res = $obj();
        return response()->json($res);
    }
    public function register(Request $req)
    {
        $obj = new RegisterPost;
        $res = $obj($req);
        return response()->json($res);
    }

    public function initializeFetch(Request $req) {
        $obj = new InitializeFetch;
        $res = $obj($req);
        return response()->json($res);
    }
}
