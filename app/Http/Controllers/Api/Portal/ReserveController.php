<?php

namespace App\Http\Controllers\Api\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Models
use App\Models\RestaurantInformation;
use App\UseCases\Reserve\Execution;
//Request
use App\Http\Requests\Reserve\ExecutionRequest;

class ReserveController extends Controller
{
    public function reserve_session_save(Request $req)
    {
        $req->session()->put('reserve_sessions', ['time' => $req['time'], 'number_of_people' => $req['numberOfPeople'], 'store' => $req['store'], 'date' => $req['date'], 'dow' => $req['dow']]);
        return response()->json(['msg' => 'OK']);
    }

    public function reserve_session_fetch(Request $req)
    {
        //入力値のsessionがあれば表示
        $reserve_session = $req->session()->get('reserve_sessions');
        $confirm_session = [];
        if ($req->session()->has('confirm_session')) {
            $confirm_session = $req->session()->get('confirm_session');
            $req->session()->forget('confirm_session');
        }
        $contents = ['reserve_session' => $reserve_session, 'confirm_session' => $confirm_session];
        return $contents;
    }

    public function confirm(Request $req)
    {
        $store = RestaurantInformation::where('id', $req['storeId'])->first()->toArray();
        $guest_info = $req['guestInformation'];
        $reserve_info = ['date' => $req['date'], 'dow' => $req['dow'], 'numberOfPeople' => $req['numberOfPeople'], 'time' => $req['time']];
        $req->session()->put('confirm_session', ['guest_info' => $guest_info, 'reserve_info' => $reserve_info, 'store_info' => $store]);
        return response()->json(['msg' => 'OK']);
    }
    public function confirm_session_fetch(Request $req)
    {
        $confirm_session = $req->session()->get('confirm_session');
        return $confirm_session;
    }

    public function execution(ExecutionRequest $req)
    {
        $obj = new Execution;
        $exec = $obj($req);
        return $exec;
    }
}
