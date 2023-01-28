<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//models
use App\Models\Reserve_data;

class ReserveController extends Controller
{
    public function list(Request $req)
    {
        $store_id = $req->session()->get('active_restaurant_id', $req['id']);
        $reserve_data = Reserve_data::where('store_id', $store_id)->get();
        $res = ['reserve_datas' => $reserve_data];
        return response()->json($res);
    }
}
