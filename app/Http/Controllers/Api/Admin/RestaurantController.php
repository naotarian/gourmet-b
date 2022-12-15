<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UseCases\Restaurant\RegisterFetch;
use App\UseCases\Restaurant\RegisterPost;
use App\UseCases\Restaurant\InitializeFetch;
use App\UseCases\Restaurant\List;
use App\UseCases\Restaurant\Information;

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

    public function initializeFetch(Request $req)
    {
        $obj = new InitializeFetch;
        $res = $obj($req);
        return response()->json($res);
    }

    public function information(Request $req)
    {
        $obj = new Information;
        $res = $obj($req);
        return response()->json($res);
    }

    public function display_change(Request $req)
    {
        $req->session()->put('active_restaurant_id', $req['id']);
        $new_session = $req->session()->get('active_restaurant_id', $req['id']);
        $res = ['newSession' => $new_session];
        return response()->json($res);
    }
}
