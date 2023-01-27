<?php

namespace App\Http\Controllers\Api\Portal;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//Models
use App\Models\RestaurantInformation;
use App\Models\Reserve_data;

class ReserveController extends Controller
{
    public function reserve_session_save(Request $req)
    {
        $req->session()->put('reserve_sessions', ['time' => $req['time'], 'number_of_people' => $req['numberOfPeople'], 'store' => $req['store'], 'date' => $req['date'], 'dow' => $req['dow']]);
        return response()->json(['msg' => 'OK']);
    }

    public function reserve_session_fetch(Request $req)
    {
        $reserve_session = $req->session()->get('reserve_sessions');
        // $contents = ['reserve_session' => $reserve_session];
        return $reserve_session;
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

    public function execution(Request $req)
    {
        $reserve_data = new Reserve_data;
        $reserve_data->store_id = $req['storeInfo']['id'];
        $reserve_data->seat_id = 1;
        $reserve_data->reserve_number = uniqid();
        $reserve_data->reserve_date = $req['reserveInfo']['date'];
        $reserve_data->reserve_time = $req['reserveInfo']['time'];
        $reserve_data->number_of_people = $req['reserveInfo']['numberOfPeople'];
        $reserve_data->first_name = $req['guestInfo']['firstName'];
        $reserve_data->last_name = $req['guestInfo']['lastName'];
        $reserve_data->contact_address = $req['guestInfo']['email'];
        $reserve_data->contact_tel = $req['guestInfo']['cellPhone'];
        $reserve_data->remarks = $req['guestInfo']['remarks'];
        $reserve_data->save();
        return response()->json(['msg' => '予約が完了しました。']);
    }
}
