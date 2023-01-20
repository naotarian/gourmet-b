<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seat;
use App\UseCases\Seat\SeatRegister;
use App\UseCases\Seat\SeatUpdate;

class SeatController extends Controller
{
    public function seats_fetch(Request $req)
    {
        $seats = Seat::where('store_id', $req->session()->get('active_restaurant_id'))->get();
        $contents = ['seats' => $seats];
        return response()->json($contents);
    }
    public function seats_register(Request $req)
    {
        $obj = new SeatRegister;
        $obj($req);
        $seats = Seat::where('store_id', $req->session()->get('active_restaurant_id'))->get();
        $contents = ['seats' => $seats];
        return response()->json($contents);
    }
    public function seats_update(Request $req)
    {
        $obj = new SeatUpdate;
        $obj($req);
        $seats = Seat::where('store_id', $req->session()->get('active_restaurant_id'))->get();
        $contents = ['seats' => $seats];
        return response()->json($contents);
    }
}
