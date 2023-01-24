<?php

namespace App\Http\Controllers\Api\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReserveController extends Controller
{
    public function reserve_session_save(Request $req)
    {
        $req->session()->put('reserve_sessions', ['time' => $req['time'], 'number_of_people' => $req['numberOfPeople']]);
        return response()->json(['msg' => 'OK']);
    }
}
