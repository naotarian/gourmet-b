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

    public function execution(Request $req)
    {
        $aes_key = config('app.aes_key');
        $aes_type = config('app.aes_type');
        $reserve_data = new Reserve_data;
        $reserve_data->store_id = $req['storeInfo']['id'];
        $reserve_data->seat_id = 1;
        $reserve_data->reserve_number = uniqid();
        $reserve_data->reserve_date = $req['reserveInfo']['date'];
        $reserve_data->reserve_time = $req['reserveInfo']['time'];
        $reserve_data->number_of_people = $req['reserveInfo']['numberOfPeople'];
        $reserve_data->first_name = openssl_encrypt($req['guestInfo']['firstName'], $aes_type, $aes_key);
        $reserve_data->last_name = openssl_encrypt($req['guestInfo']['lastName'], $aes_type, $aes_key);
        $reserve_data->contact_address = openssl_encrypt($req['guestInfo']['email'], $aes_type, $aes_key);
        $reserve_data->contact_tel = openssl_encrypt($req['guestInfo']['cellPhone'], $aes_type, $aes_key);
        $reserve_data->remarks = openssl_encrypt($req['guestInfo']['remarks'], $aes_type, $aes_key);
        $reserve_data->save();
        return response()->json(['msg' => '予約が完了しました。']);
    }
}
